<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Repositories\RoleRepository;
use Repositories\RouteRepository;

class RoleController extends Controller {
    public function __construct(RoleRepository $roleRepo,RouteRepository $routeRepo) {
        $this->roleRepo = $roleRepo;
        $this->routeRepo=$routeRepo;
    }
    public function index() {
        $roles = $this->roleRepo->getAllRole();
        return view('backend/role/index', compact('roles'));
    }
    public function create() {
        $getRouteCollection = Route::getRoutes();
        return view('backend/role/create', compact('getRouteCollection'));
    }
    public function store(Request $request){
        $input = $request->all();
        $role = $this->roleRepo->create($input);
        foreach($input['routes'] as $key=>$val){
            $route['role_id'] = $role->id;
            $route['route'] = $val;
            if(isset($input['is_default'][$key])){
                $route['is_default']=1;
            }else{
                $route['is_default']=0;
            }
            $this->routeRepo->create($route);
        }
        $getRouteCollection = Route::getRoutes();
        foreach ($getRouteCollection as $item) {
            if ($item->methods[0] == 'POST' && $item->getName() != null) {
                $input['routes'][] = $item->getName();
            }
        }
        $rote = implode(',',$input['routes']);
        $role = $this->roleRepo->update(['route'=>$rote],$role->id);
        return redirect()->route('admin.role.index')->with('success', trans('Tạo mới thành công'));
    }

    public function show($id) {

    }
    public function edit($id) {
        $role = $this->roleRepo->find($id);
        $getRouteCollection = Route::getRoutes();
        return view('backend/role/update', compact('role','getRouteCollection'));
    }
    public function update(Request $request, $id){
        $input = $request->all();
        $getRouteCollection = Route::getRoutes();
        foreach ($getRouteCollection as $item) {
            if ($item->methods[0] == 'POST' && $item->getName() != null) {
                $input['route'][] = $item->getName();
            }
        }
        $routes = $input['route'];
        $input['route'] = implode(',',$input['route']);
        $this->roleRepo->update($input, $id);
        $this->routeRepo->deleteByRole($id);
        foreach($routes as $key=>$val){
            $route['role_id'] = $id;
            $route['route'] = $val;
            $route['is_default']=0;
            $this->routeRepo->create($route);
        }
        return redirect()->route('admin.role.index')->with('success', trans('Cập nhật thành công'));
    }
    public function destroy($id) {
        $this->roleRepo->delete($id);
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
