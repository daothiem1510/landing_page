<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\CategoryRepository;
use Repositories\CustomerRepository;
use Repositories\OrderRepository;
use Repositories\UserRepository;
use Repositories\RoleRepository;
use Repositories\StaffRepository;

class CustomerController extends Controller
{

    public function __construct(CustomerRepository $customerRepo,CategoryRepository $categoryRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->categoryRepo = $categoryRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customer_html = StringHelper::getSelectOptions($this->customerRepo->all(),$request->get('customer_id'));
        $records = $this->customerRepo->all();
        return view('backend/customer/index', compact('records','customer_html'));
    }
    public function create()
    {
        return view('backend/customer/create');
    }
    public function store(Request $request) {
        $input = $request->all();
        $this->customerRepo->create($input);
        return redirect()->route('admin.customer.index')->with('success', trans('Tạo mới thành công'));

    }

    public function edit($id)
    {
        $customer = $this->customerRepo->find($id);
        return view('backend/customer/update', compact('customer'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $this->customerRepo->update($input,$id);
        return redirect()->route('admin.customer.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $this->customerRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
