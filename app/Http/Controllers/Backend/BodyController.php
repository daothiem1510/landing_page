<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use App\MenuDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\BodyRepository;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\MenuDetailRepository;
use Repositories\MenuRepository;
use Repositories\PageRepository;
use Repositories\ProductRepository;
use Repositories\SizeRepository;

class BodyController extends Controller
{

    public function __construct(BodyRepository $bodyRepo,MenuDetailRepository $menuDetailRepo,PageRepository $pageRepo,MenuRepository $menuRepo)
    {
        $this->pageRepo = $pageRepo;
        $this->menuRepo = $menuRepo;
        $this->menuDetailRepo = $menuDetailRepo;
        $this->bodyRepo = $bodyRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $this->bodyRepo->all();
        return view('backend/body/index', compact('records'));
    }
    public function create()
    {
        $page_html = StringHelper::getSelectPageOptions($this->pageRepo->all());
        return view('backend/body/create',compact('page_html'));
    }
    public function store(Request $request) {
        $input = $request->all();
        $this->bodyRepo->create($input);

        return redirect()->route('admin.body.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->bodyRepo->find($id);
        $page_html = StringHelper::getSelectPageOptions($this->pageRepo->all(),$record->page_id);
        return view('backend/body/update', compact('record','page_html'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $this->bodyRepo->update($input,$id);
        return redirect()->route('admin.body.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $this->bodyRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
