<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\ProductRepository;
use Repositories\SizeRepository;

class ProductController extends Controller
{

    public function __construct(SizeRepository $sizeRepo,ColorRepository $colorRepo,ProductRepository $productRepo,CategoryRepository $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->colorRepo = $colorRepo;
        $this->sizeRepo = $sizeRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $product_html = StringHelper::getSelectOptions($this->productRepo->all(),$request->get('product_id'));
        $records = $this->productRepo->all();
        return view('backend/product/index', compact('records','product_html'));
    }
    public function create()
    {
        $category_html = StringHelper::getSelectOptions($this->categoryRepo->all());
        $color_html = StringHelper::getSelectOptions($this->colorRepo->all());
        $size_html = StringHelper::getSelectOptions($this->sizeRepo->all());
        return view('backend/product/create',compact('category_html','color_html','size_html'));
    }
    public function store(Request $request) {
        $input = $request->all();
        $input['size_id'] = implode(',',$input['size_id']);
        $file = $request->image;
        if (isset($file)) {
            $destinationPath = 'uploads';
            $path = $destinationPath . '/' . $file->getClientOriginalName();
            $file->move($destinationPath , $file->getClientOriginalName());
            $input['image'] = $path;
        }else {
            $input['image'] = null;
        }
        $input['created_by'] = Auth::user()->id;
        $this->productRepo->create($input);
        return redirect()->route('admin.product.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->productRepo->find($id);
        $category_html = StringHelper::getSelectOptions($this->categoryRepo->all(),$record->category_id);
        $color_html = StringHelper::getSelectOptions($this->colorRepo->all(),$record->color_id);
        $size_html = StringHelper::getSelectOptions($this->sizeRepo->all(),$record->color_id);
        return view('backend/product/update', compact('record','category_html','color_html','size_html'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $file = $request->image;
        if (isset($file)) {
            $destinationPath = 'uploads';
            $path = $destinationPath . '/' . $file->getClientOriginalName();
            $file->move($destinationPath , $file->getClientOriginalName());
            $input['image'] = $path;
        }else {
            $input['image'] = $input['old_image'];
        }
        $this->productRepo->update($input,$id);
        return redirect()->route('admin.customer.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
