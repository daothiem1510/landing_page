<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\UserRepository;

class AuthController extends Controller
{
    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }
    public function login(Request $request) 
    {
       $username = $request->json()->get('username');
    
        $input = $request->only(['username', 'password']);
        if (\Auth::attempt($input)) {
            $user = \Auth::user();
            $user->save();
            return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Đăng nhập thành công',
                                'data' => \App\User::all('id','name','role_id','username','staff_id','physical_address')->where('username',$username)->first()
            ]);
        }else{
            return response()
                            ->json([
                                'isStatus' => false,
                                'message' => 'Đăng nhập không thành công',
                                'data' =>""
            ]);
        }
    }

    public function getDataForCreateOrder()
    {
      try {
         
         $users = \DB::table('user')
            ->select('user.id','user.name','user.role_id')->where('role_id',12)->get();
            ///
         return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Thông tin dữ liệu',
                                'data' => [
                                  "company"=>\App\Company::all('id','name','code'),
                                  "customer"=>\App\Customer::all('id','name','code'),
                                  // "product"=>\App\Product::all('id','code'),
                                  "project"=>\App\Project::all('id','name','is_deleted')->where('is_deleted',0),
                                  "business"=>$users ,
                                  'delivery'=>\App\Delivery::all('id','name')
                                ],
            ]); 
      } catch (Exception $e) {
         return response()
                            ->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
     
    }
    public function getCheckTotalDebtOfCustomer(Request $request)
    {
      try {
           $input = $request->all();
        $data = \App\Order::all()->where('customer_id', $input["customer_id"])->where('status', \App\Order::STATUS_ACTIVE)->where('expired_date', '<', \Carbon\Carbon::today());
        // checkout_money
        //total_order
        //user_id/
        //contract_id
          $arrayData = []; 
        if ($data == null) {
          array_push($arrayData, ["isStatus"=>true,"message"=>"Khách hàng đủ điều kiện mua hàng"]);
           return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Thông tin dữ liệu',
                                'data' => $arrayData,
                                
            ]);   
        }
        $value = 0;
        foreach ($data as $val) 
          $value += $val["total_order"] - $val["checkout_money"];
     
         if($value>0){
          array_push($arrayData, ["isStatus"=>false,"message"=>"Chưa thanh toán đơn hàng trước","total_debt_order"=>$value]);
         }else{
           array_push($arrayData, ["isStatus"=>true,"message"=>"Khách hàng đủ điều kiện mua hàng"]);
         }
        return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Thông tin dữ liệu',
                                'data' => $arrayData,
            ]);   
      } catch (Exception $e) {
        return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
    
    }
    public function getCheckTotalDebtOfBusinessMan(Request $request)
    {
      try {
        $input = $request->all();
        $data = \App\Order::all()->where('user_id', $input["user_id"])->where('status', \App\Order::STATUS_ACTIVE)->toArray();
        // checkout_money
        //total_order
        //user_id/
        //contract_id
        $arrayData = []; 
        if ($data == null) {
          array_push($arrayData, ["isStatus"=>true,"message"=>"Nhân viên đủ điều kiện mua hàng"]);
           return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Thông tin dữ liệu',
                                'data' => $arrayData,
                                
            ]);   
        }
        $total_order = 0;
        foreach ($data as $val) 
          $total_order += $val["total_order"] - $val["checkout_money"];

        $dataUser = \App\Order::all()->where('user_id',  $input["user_id"])->where('status', \App\Order::STATUS_ACTIVE)->where('expired_date', '<=', date('Y-m-d'));
        $userValue = 0;
        foreach ($dataUser as $key ) {
            $userValue += $key["total_order"] - $key["checkout_money"];
        }
         if($total_order>($userValue*0.1)){
          array_push($arrayData, ["isStatus"=>false,"message"=>"Chưa thanh toán đơn hàng trước"]);
         }else{
           array_push($arrayData, ["isStatus"=>true,"message"=>"Nhân viên đủ điều kiện mua hàng"]);
         }
        return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Thông tin dữ liệu',
                                'data' => $arrayData,
            ]);   
      } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
       
    }
    public function postCreateOrder(Request $request)
    {
      try {
        $input = $request->all(); 
          $order = new \App\Order;
          $orderDetail= new \App\OrderDetail;
          $paymentData = new \App\Payment;
          //
          $total = 0;
          $weight_total = 0;
          foreach ($input['listProduct'] as $k ){
              $total += $k["out_weight"] * $k['out_price'];
              $weight_total +=  $k["out_weight"];
          }
          $total_order = ($total + $input["shipping_unit_price"]*$weight_total + $input["lower_row"]*$weight_total + $input["delivery"])*(1 + ($input['vat'] / 100));

          $companycode = \App\Company::all('code','id')->where("id",$input['company_id'])->first();
          // print($companycode["code"]);
          $customercode = \App\Customer::all('code','id')->where("id",$input['customer_id'])->first();
          // print($companycode["code"]);
          // Tạo đơn hàng
          $code =  $customercode["code"] . '-' . $companycode["code"] . '-' . date('dmY');
          $dataOrder["created_by"] = $input["idBusiness"];
          $dataOrder["code"] = $code;
          $dataOrder["user_id"] = $input["user_id"];
          $dataOrder["total_order"] = $total_order;
          $dataOrder["customer_id"] = $input["customer_id"];
          $dataOrder["delivery_date"] = $input["delivery_date"];
          $dataOrder["expired_date"] = $input["expired_date"];
          $dataOrder["received_document_date"] = $input["received_document_date"];
          $dataOrder["company_id"] = $input["company_id"];
          $dataOrder["delivery_id"] = $input["delivery_id"];
          $dataOrder["shipping_unit_price"] = $input["shipping_unit_price"];
          $dataOrder["vat"] = $input["vat"];
          $dataOrder["lower_row"] = $input["lower_row"];
          $dataOrder["project_id"] = $input["project_id"];
          $dataOrder["debt"] = $input["debt"] == true?1:0;
          $dataOrder["debt_order_id"] = $input["debt"] == true ? $input["debt_order_id"]:0;
          $dataOrder["contract_id"] = $input["contract_id"];
          $dataOrder["status"] = 0;
          // $created_at = date("Y-m-d");
          // $order->created_at = date("Y-m-d", strtotime($created_at));
          // $order->updated_at =  date("d/m/Y", strtotime($this->updated_at));
          $order_id =  $order->create($dataOrder);
          //----ket thuc tao dơn hang
          // Tạo đơn hàng chi tiết
          foreach ($input['listProduct'] as $k ){
              $dataOrderDetail["order_id"] = $order_id["id"];
              $dataOrderDetail["product_id"] = $k["product_id"];
              $dataOrderDetail["category_id"] = $k["category_id"];
              $dataOrderDetail["quantity"] = $k["quantity"];
              $dataOrderDetail["in_price"] = $k["in_price"];
              $dataOrderDetail["out_weight"] = $k["out_weight"];
              $dataOrderDetail["out_price"] = $k["out_price"];
              $dataOrderDetail["number_sb"] = $k["number_sb"];
              $dataOrderDetail["supplier_id"] = $k["supplier_id"];
              $dataOrderDetail["export_place"] = $k["export_place"];
              $dataOrderDetail["out_total"] = $k["out_weight"] * $k["out_price"];
             $orderDetail->create($dataOrderDetail);
          } 
            //Tạo bản ghi vào phần thanh toán để làm đối chiếu công nợ
          $payment['customer_id'] = $input['customer_id'];
          $payment['checkout_money'] = 0;
          $payment['note'] = 'Tạo đơn hàng';
          $payment['order_id'] = $order_id["id"];
          $payment['created_by'] = date('Y-m-d');
          $paymentData->create($payment);

          // print($order_id["id"]);
          // // Các thông tin lưu vào bảng order
          // // code,user_id,total_order,customer_id,delivery_date,exprired_date,received_document_date,
          // //company_id,delivery_id,shipping_unit_price,vat,lower_row,delivery,project_id
          // //debt ,debt_order_id,create_by,
          // //cus_representer_id,com_representer_id,com_rep_id(người đại diện công ty khách hàng)
          // // contract_id,
          // // Các thông tin của orderDetail
          // //
          // print($input);
         return response()
                            ->json([
                                'isStatus' => true,
                                'message' => 'Tạo đơn hàng thành công',
                                'data' =>  [
                                  "idOrder"=> $order_id["id"],
                                  "total"=>$total_order,
                                ],
            ]);
      } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
          
    }
     public function getContract(Request $request)
    {
        try {
              // consolog($request);
            $input = $request->all();
            $company_id = $input["company_id"];
            $customer_id = $input['customer_id'];

            $contract = \DB::table('contract')
                ->select('contract.id','contract.code','contract.company_id','contract.customer_id')->where('company_id',$company_id)->where('customer_id',$customer_id)->get();
             return response()
                                ->json([
                                    'isStatus' => true,
                                    'message' => 'Thông tin hợp đồng',
                                    "data"=>$contract
                                    
                ]);
        } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
        }
        
    }
    public function getDelivery()
    {
      try {
         return response()
            ->json([
                'isStatus' => true,
                'message' => 'Danh sách hình thức vận chuyển',
                "data"=>\App\Delivery::all('id','name')                      
            ]);
      } catch (Exception $e) {
        return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
    }

    public function getOrderDebt(Request $request)
    {
      try {
        $customer_id = $request->json()->get('customer_id');
        return response()
                    ->json([
                        'isStatus' => true,
                        'message' => 'Danh sách vận chuyển',
                        "data"=>\App\Order::all('id','code','customer_id','debt')->where('cus
                          ',$customer_id)->where('debt',1)
                                  
              ]);
      } catch (Exception $e) {
         return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
      
    }
    public function getCategory(Request $request)
    {
      try {
        $input = $request->all();
      $product_id = $input["product_id"];
      $product_categoryID = \App\ProductCategory::all("product_id",'category_id','unit_cb','unit_kc','price','supplier_id')->where('product_id',$product_id);
       // print($product_categoryID);
      //////--------------

      $arrayDataBack = [];
       $category = \App\Category::all();
       foreach ($product_categoryID as $keyProductID) {
          foreach ($category as $keyCategoryId) {
            if($keyProductID["category_id"] == $keyCategoryId['id'] ){
              array_push($arrayDataBack, ["id"=>$keyCategoryId['id'],'name'=>$keyCategoryId["name"],'parent_id'=>$keyCategoryId["parent_id"]]);
            } 
          }
        }
      // Lấy danh sách các parent_id
      $arrayDataBack1 = [];
      foreach ($arrayDataBack as $key ) {
          foreach ($category as $keyCategoryId) {
            if($key["parent_id"] == $keyCategoryId['id'] ){
              array_push($arrayDataBack1, ["id"=>$keyCategoryId['id'],'name'=>$keyCategoryId["name"],'parent_id'=>$keyCategoryId["parent_id"]]);
            } 
          }
      }
     // Loại bỏ phần tử trùng nhau trong mảng
      foreach($arrayDataBack1 as $key1)
      {
         $data = ['id'=>$key1['id'],'name'=>$key1['name'],'parent_id'=>$key1['parent_id']];
        if(in_array($data,$arrayDataBack,TRUE)){
           // array_push($arrayDataBack, ['id'=>$key1['id'],'name'=>$key1['name'],'parent_id'=>$key1['parent_id']]);
        }else{
            array_push($arrayDataBack,$data);
        }
      }

      return response()
                        ->json([
                            'isStatus' => true,
                            'message' => 'Danh sách vận chuyển',
                            "data"=>$arrayDataBack
                                
            ]);
      } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
       

    }
     public function getSupplier(Request $request)
    {
      try {
          return response()
                ->json([
                    'isStatus' => true,
                    'message' => 'Danh sách nhà cung cấp',
                    "data"=>\App\Supplier::all("id",'name')
                                
            ]);
      } catch (Exception $e) {
           return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
      
    }
    public function getProduct(Request $request)
    {
      try {
            return response()
                ->json([
                    'isStatus' => true,
                    'message' => 'Danh sách sản phẩm',
                    "data"=>\App\Product::all("id",'code')
                                
            ]);
      } catch (Exception $e) {
           return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
      
    }
     public function getCategoryidProductidSupplierid(Request $request)
    {
      try {
               // $customer_id = $request->json()->get('category_id');
          $input = $request->all();
          $productcategory = \DB::table('product_category')
                ->select('product_category.category_id','product_id','name','unit_cb','unit_kc','price',
                  'supplier_id','discount','profit')->where('category_id',$input["category_id"])->where('product_id',$input["product_id"])->where('supplier_id',$input["supplier_id"])->get();

          return response()
                    ->json([
                        'isStatus' => true,
                        'message' => 'Thông tin sản phẩm',
                        "data"=>$productcategory
                                    
                ]);
      } catch (Exception $e) {
           return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
      
    }
    public function getOrderByCustomerId(Request $request)
    {
      try {
          $input = $request->all();
           $data  = \DB::table('order')->select('id','code')->where('customer_id',$input["customer_id"])->get();
            return response()
                  ->json([
                      'isStatus' => true,
                      'message' => 'Thông tin sản phẩm',
                      "data"=>$data
              ]);
      } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
       
    }
    public function postAddNewProject(Request $request)
    {
      try {
        $input = $request->all();
        $project = new \App\Project;
        /// Thêm dự án
        $data["name"] = $input["name"];
        $data["qs"] = $input["qs"];
        $data["qc"] = $input["qc"];
        $data["mechanism"] = $input["mechanism"];
        $data["phone"] = $input["phone"];
        $data["contact_name"] = $input["contact_name"];
        $data["receiver"] = $input["receiver"];
        $data["qs_phone"] = $input["qs_phone"];
        $data["qc_phone"] = $input["qc_phone"];
        $data["is_deleted"] = $input["is_deleted"];
        $project->create($data);
        // print($input);
        return response()
                ->json([
                    'isStatus' => true,
                    'message' => 'Đã thêm dự án thành công',
                    "data"=>$project["id"]
                                
            ]);
      } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
        
    }
    public function getProject()
    {
      try {
          return response()
                ->json([
                    'isStatus' => true,
                    'message' => 'Danh sách dự án',
                    "data"=>\App\Project::all()
                                
            ]);
      } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
       
    }
    public function postCreateDelivery(Request $request)
    {
      try {
        $input = $request->all();
        $delivery = new \App\Delivery;
        $data["name"] = $input["name"];
        $delivery-> create($data);
        return response()
                ->json([
                    'isStatus' => true,
                    'message' => 'Đã thêm phương thức vận chuyển thành công',
                    "data"=>$delivery["id"]
                                
            ]);
      } catch (Exception $e) {
           return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
      }
     
    }
    public function getOrder()
    {
        try {
          $arrayData = [];
          // $data = \App\Order::all()->where("status",'!=',2)->join();

          // foreach ($data as $key) {
          //   array_push($arrayData,$key );
          // }

           // $query = \DB::table('order')->join('order_detail','order.id','order_detail.order_id')
           //      ->join('customer','order.customer_id','customer.id')
           //      ->join('product','product.id','order_detail.product_id')
           //      ->join('category','order_detail.category_id','category.id')
           //      ->select('category.name as category_name','customer.name as customer_name','product.code as product_name','order.receipt_date_supplier','order.expired_date_supplier','order_detail.in_weight','order_detail.in_price','order_detail.in_total','order_detail.supplier_id');

            // $query = \App\Order::all()->join('order_detail','order.id','order_detail.order_id')
            //     ->join('customer','order.customer_id','customer.id')
            //     ->join('product','product.id','order_detail.product_id')
            //     ->join('category','order_detail.category_id','category.id')
            //     ->select('category.name as category_name','customer.name as customer_name','product.code as product_name','order.receipt_date_supplier','order.expired_date_supplier','order_detail.in_weight','order_detail.in_price','order_detail.in_total','order_detail.supplier_id');
          
          $users = \DB::table('order')
            ->join('customer', 'order.customer_id', '=', 'customer.id')
            // ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('order.id','order.code','order.user_id','order.total_order','order.checkout_money',
              'order.expired_date','order.status','order.debt', 'customer.name')
            ->get();
           return response()
                ->json([
                    'isStatus' => true,
                    'message' => 'Danh sách đơn hàng',
                    "data"=>$users
                                
            ]);
        } catch (Exception $e) {
          return response()->json([
                                'isStatus' => false,
                                'message' => 'Lỗi trong quá trình xử lý',
                              ]);
        }
      
    }


}
