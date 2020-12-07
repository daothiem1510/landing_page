<?php

namespace App\Http\Controllers\Api;

use App\Helpers\StringHelper;
use App\ImportStock;
use App\Machine;
use App\Material;
use App\Repositories\MachineArrangementDetailRepository;
use App\Repositories\ProducedDetailRepository;
use App\Repositories\ScrapDetailRepository;
use App\Repositories\ScrapHistoryRepository;
use App\Repositories\ScrapRepository;
use App\Repositories\StockHistoryRepository;
use App\ScrapHistory;
use App\StockHistory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\CustomerRepository;
use Repositories\ImportStockRepository;
use Repositories\RouteRepository;
use Repositories\UserRepository;


class BackendController extends Controller {

    //
    public function __construct() {

    }
    public function getPlugByName(Request $request) {
        $alias = StringHelper::getAlias($request->get('name'));
        return response()->json(['alias'=>$alias]);
    }
    public function getHtmlTypeBlock(Request $request) {
        $type = $request->get('type');
        if ($type == 1) {
            $html = '
                    <label class="col-md-2 col-form-label text-right">Ảnh <span class="text-danger">*</span></label>
                        <div class="col-md-7">
                        <input type="file" class="file-input" name="values" data-fouc>
                    </div>';
        }else {
            $html = '
                <label class="col-md-2 col-form-label text-right">Link video <span class="text-danger">*</span></label>
                 <div class="col-md-7">
                <input type="text" class="form-control" name="values" >
                </div>
            ';
        }
        return response()->json(['html'=>$html]);
    }
}
