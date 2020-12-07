<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\CustomerRepository;
use Repositories\OrderRepository;
use Repositories\UserRepository;
use Repositories\RoleRepository;
use Repositories\StaffRepository;

class ColorController extends Controller
{

    public function __construct(ColorRepository $colorRepo,CustomerRepository $customerRepo,CategoryRepository $categoryRepo)
    {
        $this->customerRepo = $customerRepo;
        $this->categoryRepo = $categoryRepo;
        $this->colorRepo = $colorRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $color_html = StringHelper::getSelectOptions($this->colorRepo->all(),$request->get('color_id'));
        $records = $this->colorRepo->all();
        return view('backend/color/index', compact('records','color_html'));
    }
    public function create()
    {
        return view('backend/color/create');
    }
    public function store(Request $request) {
        $input = $request->all();
        $this->colorRepo->create($input);
        return redirect()->route('admin.color.index')->with('success', trans('Tạo mới thành công'));

    }

    public function edit($id)
    {
        $color = $this->colorRepo->find($id);
        return view('backend/color/update', compact('color'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $this->colorRepo->update($input,$id);
        return redirect()->route('admin.color.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $this->colorRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
