<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\UserRepository;
use Repositories\RoleRepository;
use Repositories\StaffRepository;

class UserController extends Controller {

    public function __construct(StaffRepository $staffRepo,UserRepository $userRepo, RoleRepository $roleRepo) {
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
        $this->staffRepo=$staffRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $records = $this->userRepo->getAllUser();
        return view('backend/user/index', compact('records'));
    }

    public function create() {
        $roles = $this->roleRepo->getAllRole();
        $data = $this->staffRepo->getAll();
        foreach($data as $key=>$val){
          $data[$key]->name= $val->full_name;
        }
        $staff_html = \App\Helpers\StringHelper::getSelectUserOptions($data);
        return view('backend/user/create', compact('roles','staff_html'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $staff = $this->staffRepo->find($input['staff_id']);
        $input['password'] = bcrypt(123456);
        $input['username'] = \App\Helpers\StringHelper::slug($staff->full_name);
        $input['name'] = $staff->full_name;
        $validator = \Validator::make($input, $this->userRepo->validateCreate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->userRepo->create($input);
        return redirect()->route('admin.user.index');
    }

    public function edit($id) {
        $record = $this->userRepo->find($id);
        $roles = $this->roleRepo->all();
        return view('backend/user/update', compact('record', 'roles'));
    }

    public function editProfile() {
        $record = \Auth::user();
        return view('backend/user/edit_profile', compact('record'));
    }

    public function updateProfile(Request $request) {
        $id = \Auth::user()->id;
        $input = $request->all();
        $validator = \Validator::make($input, $this->userRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!$input['password']) {
            unset($input['password']);
        } else {
            $password = $request->get('password');
            $input['password'] = bcrypt($password);
        }
        $this->userRepo->update($input, $id);
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    public function update(Request $request, $id) {
        $input = $request->all();
        $validator = \Validator::make($input, $this->userRepo->validateUpdate($id));
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->userRepo->update($input, $id);
        return redirect()->route('admin.user.edit', $id)->with('success', 'Update thành công');
    }

    public function destroy($id) {
        $this->userRepo->delete($id);
        return redirect()->route('admin.user.index')->with('success', 'Xóa thành công');
    }

}
