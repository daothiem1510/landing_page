<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\ScrapHistoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use kcfinder\session;
use Linfo\Laravel\Models\Linfo;

class BackendController extends Controller {

    public function __construct() {

    }
    public function index(Request $request) {
        return view('backend/index');
    }
}
