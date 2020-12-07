<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\PageRepository;
use Repositories\ProductRepository;
use Repositories\SizeRepository;

class PageController extends Controller
{

    public function __construct(PageRepository $pageRepo,SizeRepository $sizeRepo,ColorRepository $colorRepo,ProductRepository $productRepository,CategoryRepository $categoryRepo)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepo = $categoryRepo;
        $this->colorRepo = $colorRepo;
        $this->sizeRepo = $sizeRepo;
        $this->pageRepo = $pageRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_html = StringHelper::getSelectOptions($this->productRepository->all(),$request->get('product_id'));
        $records = $this->pageRepo->all();
        return view('backend/page/index', compact('records','product_html'));
    }
    public function create()
    {
        $product_html = StringHelper::getSelectProductOptions($this->productRepository->all());
        return view('backend/page/create',compact('product_html'));
    }
    public function store(Request $request) {
        $input = $request->all();
        $input['created_by'] = Auth::user()->id;
        $file = $request->logo;
        if (isset($file)) {
            $destinationPath = 'uploads';
            $path = $destinationPath . '/' . $file->getClientOriginalName();
            $file->move($destinationPath , $file->getClientOriginalName());
            $input['logo'] = $path;
        }else {
            $input['logo'] = null;
        }
        $this->pageRepo->create($input);
        return redirect()->route('admin.page.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->pageRepo->find($id);
        $product_html = StringHelper::getSelectProductOptions($this->productRepository->all(),$record->product_id);
        return view('backend/page/update', compact('product_html','record'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $file = $request->logo;
        if (isset($file)) {
            $destinationPath = 'uploads';
            $path = $destinationPath . '/' . $file->getClientOriginalName();
            $file->move($destinationPath , $file->getClientOriginalName());
            $input['logo'] = $path;
        }else {
            $input['logo'] = $input['old_logo'];
        }
        $this->pageRepo->update($input,$id);
        return redirect()->route('admin.page.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $page = $this->pageRepo->find($id);
        $page->head->delete();
        $page->body->delete();
        $this->pageRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
