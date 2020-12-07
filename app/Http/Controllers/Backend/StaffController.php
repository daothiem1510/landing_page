<?php

namespace App\Http\Controllers\Backend;

use App\Imports\StaffImport;
use App\Repositories\DepartmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\StaffRepository;
use Repositories\PositionRepository;
use Repositories\UserRepository;

class StaffController extends Controller {

    public function __construct(UserRepository $userRepo,StaffRepository $staffRepo,PositionRepository $positionRepo) {
        $this->staffRepo = $staffRepo;
        $this->positionRepo = $positionRepo;
        $this->userRepo = $userRepo;
    }

    public function index(){
        $records = $this->staffRepo->all();
        return view('backend/staff/index', compact('records'));
    }

    public function createNewCode(){
        $next_id = \DB::table('staff')->max('id') + 1;
        if ($next_id >= 1000) {
            return 'MT' . $next_id;
        } else if ($next_id >= 100) {
            return 'MT0' . $next_id;
        } else if ($next_id >= 10) {
            return 'MT00' . $next_id;
        } else {
            return 'MT000' . $next_id;
        }
    }
    public function create(){
        //Create staff code
        $next_code = $this->createNewCode();
        $position_html = \App\Helpers\StringHelper::getSelectOptions($this->positionRepo->all());
        return view('backend/staff/create', compact('position_html', 'next_code'));
    }

    public function store(Request $request){
        $input = $request->all();
        $validator = \Validator::make($input, $this->staffRepo->validate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        $file = $request->file;
        if (isset($file)) {
            if (count($file) > 0) {
                foreach ($file as $key => $val) {
                    $destinationPath = 'uploads';
                    $file[$key] = $destinationPath . '/' . $val->getClientOriginalName();
                    $val->move($destinationPath, $val->getClientOriginalName());
                }
                $input['file'] = implode(',', $file);
            } else {
                $input['file'] = null;
            }
        }
        $degree = $request->degree;
        if (isset($degree)) {
            if (count($degree) > 0) {
                foreach ($degree as $key => $val) {
                    $destinationPath = 'uploads';
                    $degree[$key] = $destinationPath . '/' . $val->getClientOriginalName();
                    $val->move($destinationPath, $val->getClientOriginalName());
                }
                $input['degree'] = implode(',', $degree);
            } else {
                $input['degree'] = null;
            }
        }
        $item = $this->staffRepo->create($input);
        if ($item->id) {
            return redirect()->route('admin.staff.index')->with('success', 'Tạo mới thành công');
        } else {
            return redirect()->route('admin.staff.index')->with('error', 'Tạo mới thất bại');
        }
    }
    public function show($id) {
        //
    }

    public function edit($id) {
        $record = $this->staffRepo->find($id);
        $position_html = \App\Helpers\StringHelper::getSelectOptions($this->positionRepo->all(), $record->position_id);
        $department_html = \App\Helpers\StringHelper::getSelectOptions($this->departmentRepo->all(), $record->department_id);
        return view('backend/staff/edit', compact('position_html', 'record','department_html'));
    }

    public function update(Request $request, $id) {

        $input = $request->all();
        $validator = \Validator::make($input, $this->staffRepo->validate());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        // giấy khám sức khỏe
        $file = $request->file;
        if ($request->get('old_file')) {
            $old_file = explode(',', $request->get('old_file'));
        } else {
            $old_file = [];
        }
        if (isset($file)) {
            if (count($file) > 0) {
                foreach ($file as $key => $val) {
                    $destinationPath = 'uploads';
                    $file[$key] = $destinationPath . '/' . $val->getClientOriginalName();
                    $val->move($destinationPath, $val->getClientOriginalName());
                }
                $input['file'] = array_merge($old_file, $file);
                $input['file'] = implode(',', $input['file']);
            } else {
                $input['file'] = null;
            }
        } else {
            $input['file'] = implode(',', $old_file);
        }
        // bằng cấp
        $degree = $request->degree;
        if ($request->get('old_degree')) {
            $old_degree = explode(',', $request->get('old_degree'));
        } else {
            $old_degree = [];
        }
        if (isset($degree)) {
            if (count($degree) > 0) {
                foreach ($degree as $key => $val) {
                    $destinationPath = 'uploads';
                    $degree[$key] = $destinationPath . '/' . $val->getClientOriginalName();
                    $val->move($destinationPath, $val->getClientOriginalName());
                }
                $input['degree'] = array_merge($old_degree, $degree);
                $input['degree'] = implode(',', $input['degree']);
            } else {
                $input['degree'] = null;
            }
        } else {
            $input['degree'] = implode(',', $old_degree);
        }
        $item = $this->staffRepo->update($input, $id);
        if ($item) {
            return redirect()->route('admin.staff.index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect()->route('admin.staff.index')->with('error', 'Cập nhật thất bại');
        }
    }

    public function destroy($id) {
        $staff = $this->staffRepo->find($id);
        $this->staffRepo->update(['is_deleted'=>1],$id);
        return redirect()->route('admin.staff.index')->with('success', 'Xóa thành công');
    }

    public function import() {
        if ($_FILES['select_file']) {
            // get file extension
            $extension = pathinfo($_FILES['select_file']['name'], PATHINFO_EXTENSION);
            if ($extension == 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            // file path
            $spreadsheet = $reader->load($_FILES['select_file']['tmp_name']);
            $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            foreach ($allDataInSheet as $key => $row) {
                //Lấy dứ liệu từ dòng thứ 4
                if ($key > 2) {
                    $input['department_id'] = $this->departmentRepo->getDepartmentId($row['B']);
                    $input['code'] = $this->createNewCode();
                    $input['full_name'] = $row['D'];
                    $input['position_id'] = $this->positionRepo->getPositionId($row['E']);
                    $input['start_date'] = date('Y-m-d', strtotime(str_replace('/','-',$row['F'])));
                    $input['contract_level_1'] = $row['G'];
                    $input['contract_level_2'] = $row['H'];
                    $input['contract_level_3'] = $row['I'];
                    if ($row['J'] == 'Nam') {
                        $input['gender'] = 1;
                    } else {
                        $input['gender'] = 2;
                    }
                    $input['dob'] = date('Y-m-d', strtotime(str_replace('/','-',$row['K'])));
                    $input['identification'] = $row['L'];
                    $input['identification_date'] = date('Y-m-d', strtotime(str_replace('/','-',$row['M'])));
                    $input['identification_place'] = $row['N'];
                    $input['address'] = $row['O'];
                    $input['permanent_address'] = $row['P'];
                    $input['km'] = str_replace(',','',$row['Q']);
                    $input['phone'] = $row['R'];
                    $input['educational_level'] = $row['S'];
                    $input['insuarance'] = $row['T'];
                    $input['tax_code'] = $row['U'];
                    $input['status'] = 1;
                    $this->staffRepo->create($input);
                }
            }
        }
        return redirect()->route('admin.staff.index')->with('success', 'Thêm dữ liệu thành công');
    }

}
