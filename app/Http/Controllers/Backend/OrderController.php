<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repositories\OrderRepository;
use Repositories\UserRepository;
use Repositories\RoleRepository;
use Repositories\StaffRepository;

class OrderController extends Controller
{

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepo = $orderRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->orderRepo->all();
        return view('backend/order/index', compact('records'));
    }
}
