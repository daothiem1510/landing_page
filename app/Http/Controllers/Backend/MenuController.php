<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use App\MenuDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\MenuDetailRepository;
use Repositories\MenuRepository;
use Repositories\PageRepository;
use Repositories\ProductRepository;
use Repositories\SizeRepository;

class MenuController extends Controller
{

    public function __construct(MenuDetailRepository $menuDetailRepo,PageRepository $pageRepo,MenuRepository $menuRepo)
    {
        $this->pageRepo = $pageRepo;
        $this->menuRepo = $menuRepo;
        $this->menuDetailRepo = $menuDetailRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $this->menuRepo->all();
        return view('backend/menu/index', compact('records'));
    }
    public function create()
    {
        $page_html = StringHelper::getSelectMenuOptions($this->pageRepo->all());
        return view('backend/menu/create',compact('page_html'));
    }
    public function store(Request $request) {
        $input = $request->all();
        $menu['page_id'] = $input['page_id'];
        $menu_add = $this->menuRepo->create($menu);
        foreach ($input['name'] as $key => $name) {
            $detail['name'] = $name;
            $detail['link'] = $input['link'][$key];
            $detail['menu_id'] = $menu_add->id;
            $this->menuDetailRepo->create($detail);
        }
        return redirect()->route('admin.menu.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->menuRepo->find($id);
        $page_html = StringHelper::getSelectPageOptions($this->pageRepo->all(),$record->page_id);
        return view('backend/menu/update', compact('record','page_html'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $menu_update = $this->menuRepo->find($id);
        $menu['page_id'] = $input['page_id'];
        $this->menuRepo->update($input,$id);
        $menu_update->menuDetail()->delete();
        foreach ($input['name'] as $key => $name) {
            $detail['name'] = $name;
            $detail['link'] = $input['link'][$key];
            $detail['menu_id'] = $id;
            $this->menuDetailRepo->create($detail);
        }
        return redirect()->route('admin.menu.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $menu = $this->menuRepo->delete($id);
        $menu->menuDetail()->delete();
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
