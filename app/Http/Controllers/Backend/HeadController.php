<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\HeadRepository;
use Repositories\PageRepository;
use Repositories\ProductRepository;
use Repositories\SizeRepository;

class HeadController extends Controller
{

    public function __construct(PageRepository $pageRepo,HeadRepository $headRepo,SizeRepository $sizeRepo,ColorRepository $colorRepo,ProductRepository $productRepo,CategoryRepository $categoryRepo)
    {
        $this->productRepo = $productRepo;
        $this->categoryRepo = $categoryRepo;
        $this->colorRepo = $colorRepo;
        $this->sizeRepo = $sizeRepo;
        $this->headRepo = $headRepo;
        $this->pageRepo = $pageRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page_html = StringHelper::getSelectPageOptions($this->pageRepo->all(),$request->get('page_id'));
        $records = $this->headRepo->all();
        return view('backend/head/index', compact('records','page_html'));
    }
    public function create()
    {
        $page_html = StringHelper::getSelectPageOptions($this->pageRepo->all());
        return view('backend/head/create',compact('page_html'));
    }
    public function store(Request $request) {
        $input = $request->all();
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
        $this->headRepo->create($input);
        return redirect()->route('admin.head.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->headRepo->find($id);
        $page_html = StringHelper::getSelectPageOptions($this->pageRepo->all(),$record->page_id);
        return view('backend/head/update', compact('record','page_html'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $files = $request->image;
        if (isset($files)) {
            if (count($files) > 0) {
                foreach ($files as $key => $val) {
                    $destinationPath = 'uploads';
                    $files[$key] = $destinationPath . '/' . $val->getClientOriginalName();
                    $val->move($destinationPath, $val->getClientOriginalName());
                }
                $input['image'] = implode(',', $files);
            } else {
                $input['image'] = null;
            }
        }
        $this->headRepo->update($input,$id);
        return redirect()->route('admin.head.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $this->headRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
