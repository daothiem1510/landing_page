<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\StringHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TemplateSettingRepository;
use App\Repositories\TemplateAttributeRepository;
use Repositories\ProductRepository;

class TemplateSettingController extends Controller {
    public function __construct(ProductRepository $productRepository,TemplateSettingRepository $templateRepo,TemplateAttributeRepository $attribute) {
        $this->templateRepo = $templateRepo;
        $this->attribute=$attribute;
        $this->productRepository=$productRepository;
    }

    public function index() {
        $records = $this->templateRepo->getAll();
        $attributes=$this->attribute->getAll()->toArray();
        $attribute = array();
        foreach($attributes as $key=>$val){
            $attribute[$val['title']]=$val;
        }
        return view('backend/template_setting/index', compact('records','attribute'));
    }
    public function create() {
        $attribute_html = \App\Helpers\StringHelper::getSelectOptionsTemplate($this->attribute->getAll());
        $product_html = StringHelper::getSelectProductOptions($this->productRepository->all());
        return view('backend/template_setting/create',compact('attribute_html','product_html'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $this->templateRepo->create($input);
        return redirect()->route('admin.template_setting.index')->with('success', 'Tạo mới thành công');
    }


}
