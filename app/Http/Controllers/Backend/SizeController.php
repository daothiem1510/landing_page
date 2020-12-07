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

class SizeController extends Controller
{

    public function __construct(SizeRepository $sizeRepo,ColorRepository $colorRepo,ProductRepository $productRepository,CategoryRepository $categoryRepo)
    {
        $this->productRepository = $productRepository;
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
        $records = $this->sizeRepo->all();
        return view('backend/size/index', compact('records'));
    }
    public function create()
    {
        return view('backend/size/create');
    }
    public function store(Request $request) {
        $input = $request->all();
        $this->sizeRepo->create($input);
        return redirect()->route('admin.size.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->sizeRepo->find($id);
        return view('backend/size/update', compact('record'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $this->sizeRepo->update($input,$id);
        return redirect()->route('admin.size.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $this->sizeRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
