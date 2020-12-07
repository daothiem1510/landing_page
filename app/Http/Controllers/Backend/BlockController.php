<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use App\MenuDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Repositories\BlockDetailRepository;
use Repositories\BlockRepository;
use Repositories\BodyRepository;
use Repositories\CategoryRepository;
use Repositories\ColorRepository;
use Repositories\MenuDetailRepository;
use Repositories\MenuRepository;
use Repositories\PageRepository;
use Repositories\ProductRepository;
use Repositories\SizeRepository;

class BlockController extends Controller
{

    public function __construct(BlockRepository $blockRepo,BlockDetailRepository $blockDetailRepo,BodyRepository $bodyRepo,MenuDetailRepository $menuDetailRepo,PageRepository $pageRepo,MenuRepository $menuRepo)
    {
        $this->pageRepo = $pageRepo;
        $this->menuRepo = $menuRepo;
        $this->menuDetailRepo = $menuDetailRepo;
        $this->bodyRepo = $bodyRepo;
        $this->blockRepo = $blockRepo;
        $this->blockDetailRepo = $blockDetailRepo;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = $this->blockRepo->all();
        return view('backend/block/index', compact('records'));
    }
    public function create()
    {
        $body_html = StringHelper::getSelectBodyOptions($this->bodyRepo->all());
        return view('backend/block/create',compact('body_html'));
    }
    public function store(Request $request) {
        $input = $request->all();
        $block['body_id'] = $input['body_id'];
        if ($input['type'] == 1 ) {
            $file = $request->values;
            if (isset($file)) {
                $destinationPath = 'uploads';
                $path = $destinationPath . '/' . $file->getClientOriginalName();
                $file->move($destinationPath , $file->getClientOriginalName());
                $block['values'] = $path;
            }else {
                $block['values'] = '';
            }
        }else {
            $block['values'] = $request->get('values');
        }
        $block['type'] = $input['type'];
        $block['title'] = $input['title'];
        $block['order_by'] = $input['order_by'];
        $block['description'] = $input['description'];
        $block_add = $this->blockRepo->create($block);
        foreach ($input['detail_title'] as $key => $detail_title) {
            $image = $input['detail_image'][$key];
            if (isset($image)) {
                $destinationPath = 'uploads';
                $path = $destinationPath . '/' . $image->getClientOriginalName();
                $image->move($destinationPath , $image->getClientOriginalName());
                $detail['image'] = $path;
            }else {
                $detail['image'] = '';
            }
            $detail['block_id'] = $block_add->id;
            $detail['title'] =$detail_title;
            $detail['description'] =$input['detail_description'][$key];
            $this->blockDetailRepo->create($detail);
        }
        return redirect()->route('admin.block.index')->with('success', trans('Tạo mới thành công'));
    }

    public function edit($id)
    {
        $record = $this->blockRepo->find($id);
        $body_html = StringHelper::getSelectBodyOptions($this->bodyRepo->all(),$record->body_id);
        return view('backend/block/update', compact('record','body_html'));
    }
    public function update(Request $request,$id) {
        $input = $request->all();
        $block_old = $this->blockRepo->find($id);
        $block['body_id'] = 1 /*$input['body_id']*/;
        if ($input['type'] == 1 ) {
            $file = $request->values;
            if (isset($file)) {
                $destinationPath = 'uploads';
                $path = $destinationPath . '/' . $file->getClientOriginalName();
                $file->move($destinationPath , $file->getClientOriginalName());
                $block['values'] = $path;
            }else {
                $block['values'] = $input['old_values'];
            }
        }else {
            $block['values'] = $request->get('values');
        }
        $block['type'] = $input['type'];
        $block['title'] = $input['title'];
        $block['order_by'] = $input['order_by'];
        $block['description'] = $input['description'];
        $this->blockRepo->update($block,$id);
        $block_old->blockDetail()->delete();
        $key_check = [];
        if (!is_null($request->detail_image)) {
            foreach ($request->detail_image as $k=>$detail_image) {
                $key_check[] += $k;
            }
        }
        foreach ($input['detail_title'] as $key => $detail_title) {
            if (in_array($key,$key_check)) {
                $image = $request->detail_image[$key];
                $destinationPath = 'uploads';
                $path = $destinationPath . '/' . $image->getClientOriginalName();
                $image->move($destinationPath , $image->getClientOriginalName());
                $detail['image'] = $path;
            }else {
                $detail['image'] = $input['old_detail_image'][$key];
            }
            $detail['block_id'] = $id;
            $detail['title'] =$detail_title;
            $detail['description'] =$input['detail_description'][$key];
            $this->blockDetailRepo->create($detail);
        }
        return redirect()->route('admin.block.index')->with('success', trans('Cập nhật thành công'));

    }
    public function destroy($id)
    {
        $menu = $this->menuRepo->delete($id);
        $menu->menuDetail()->delete();
        return redirect()->back()->with('success', trans('Xóa thành công'));
    }
}
