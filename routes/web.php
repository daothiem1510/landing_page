<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');
Route::group(['prefix' => 'admin','middleware' => 'admin'], function() {
    /* phòng ban */
    Route::get('/householdDepartment', ['as' => 'admin.household_department.index', 'uses' => 'Backend\BackendController@householdDepartment']);
    //import_stockRoute::get('/transport_department', ['as' => 'admin.transport_department.index', 'uses' => 'Backend\BackendController@transportDepartment']);
    Route::get('/warehouse', ['as' => 'admin.warehouse_department.index', 'uses' => 'Backend\BackendController@Warehouse']);
    Route::get('/accounting_department', ['as' => 'admin.accounting_department.index', 'uses' => 'Backend\BackendController@accountingDepartment']);
    Route::get('/bank_accounting', ['as' => 'admin.bank_department.index', 'uses' => 'Backend\BackendController@bankAccounting']);
   // Route::get('/choose/{company_id}', ['as' => 'admin.company.choose', 'uses' => 'Backend\BackendController@choose']);
    Route::get('/', ['as' => 'admin.index', 'uses' => 'Backend\BackendController@index']);

    /* Quản lý user */
    Route::get('/user', ['as' => 'admin.user.index', 'uses' => 'Backend\UserController@index']);
    Route::get('/user/create', ['as' => 'admin.user.create', 'uses' => 'Backend\UserController@create']);
    Route::post('/user/store', ['as' => 'admin.user.store', 'uses' => 'Backend\UserController@store']);
    Route::get('/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Backend\UserController@edit']);
    Route::post('/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'Backend\UserController@update']);
    Route::get('/user/edit_profile', ['as' => 'admin.user.edit_profile', 'uses' => 'Backend\UserController@editProfile']);
    Route::post('/user/update_profile', ['as' => 'admin.user.update_profile', 'uses' => 'Backend\UserController@updateProfile']);
    Route::delete('/user/delete/{id}', ['as' => 'admin.user.destroy', 'uses' => 'Backend\UserController@destroy']);

    /* Quản lý khách hàng */
    Route::get('/customer', ['as' => 'admin.customer.index', 'uses' => 'Backend\CustomerController@index']);
    Route::get('/customer/create', ['as' => 'admin.customer.create', 'uses' => 'Backend\CustomerController@create']);
    Route::post('/customer/store', ['as' => 'admin.customer.store', 'uses' => 'Backend\CustomerController@store']);
    Route::get('/customer/edit/{id}', ['as' => 'admin.customer.edit', 'uses' => 'Backend\CustomerController@edit']);
    Route::post('/customer/update/{id}', ['as' => 'admin.customer.update', 'uses' => 'Backend\CustomerController@update']);
    Route::delete('/customer/delete/{id}', ['as' => 'admin.customer.destroy', 'uses' => 'Backend\CustomerController@destroy']);
  /* Quản lý khách hàng */
    Route::get('/color', ['as' => 'admin.color.index', 'uses' => 'Backend\ColorController@index']);
    Route::get('/color/create', ['as' => 'admin.color.create', 'uses' => 'Backend\ColorController@create']);
    Route::post('/color/store', ['as' => 'admin.color.store', 'uses' => 'Backend\ColorController@store']);
    Route::get('/color/edit/{id}', ['as' => 'admin.color.edit', 'uses' => 'Backend\ColorController@edit']);
    Route::post('/color/update/{id}', ['as' => 'admin.color.update', 'uses' => 'Backend\ColorController@update']);
    Route::delete('/color/delete/{id}', ['as' => 'admin.color.destroy', 'uses' => 'Backend\ColorController@destroy']);
    /* Quản lý khách hàng */
    Route::get('/head', ['as' => 'admin.head.index', 'uses' => 'Backend\HeadController@index']);
    Route::get('/head/create', ['as' => 'admin.head.create', 'uses' => 'Backend\HeadController@create']);
    Route::post('/head/store', ['as' => 'admin.head.store', 'uses' => 'Backend\HeadController@store']);
    Route::get('/head/edit/{id}', ['as' => 'admin.head.edit', 'uses' => 'Backend\HeadController@edit']);
    Route::post('/head/update/{id}', ['as' => 'admin.head.update', 'uses' => 'Backend\HeadController@update']);
    Route::delete('/head/delete/{id}', ['as' => 'admin.head.destroy', 'uses' => 'Backend\HeadController@destroy']);
    /* Quản lý nhân viên */
    Route::get('/staff', ['as' => 'admin.staff.index', 'uses' => 'Backend\StaffController@index']);
    Route::get('/staff/create', ['as' => 'admin.staff.create', 'uses' => 'Backend\StaffController@create']);
    Route::post('/staff/store', ['as' => 'admin.staff.store', 'uses' => 'Backend\StaffController@store']);
    Route::get('/staff/edit/{id}', ['as' => 'admin.staff.edit', 'uses' => 'Backend\StaffController@edit']);
    Route::post('/staff/update/{id}', ['as' => 'admin.staff.update', 'uses' => 'Backend\StaffController@update']);
    Route::delete('/staff/delete/{id}', ['as' => 'admin.staff.destroy', 'uses' => 'Backend\StaffController@destroy']);
    Route::post('/staff/import', ['as' => 'admin.staff.import', 'uses' => 'Backend\StaffController@import']);

    /* Quản lý chức danh */
    Route::get('/position', ['as' => 'admin.position.index', 'uses' => 'Backend\PositionController@index']);
    Route::get('/position/create', ['as' => 'admin.position.create', 'uses' => 'Backend\PositionController@create']);
    Route::post('/position/store', ['as' => 'admin.position.store', 'uses' => 'Backend\PositionController@store']);
    Route::get('/position/edit/{id}', ['as' => 'admin.position.edit', 'uses' => 'Backend\PositionController@edit']);
    Route::post('/position/update/{id}', ['as' => 'admin.position.update', 'uses' => 'Backend\PositionController@update']);
    Route::delete('/position/delete/{id}', ['as' => 'admin.position.destroy', 'uses' => 'Backend\PositionController@destroy']);

    /* Quản lý danh mục sản phẩm */
    Route::get('/category', ['as' => 'admin.category.index', 'uses' => 'Backend\CategoryController@index']);
    Route::get('/category/create', ['as' => 'admin.category.create', 'uses' => 'Backend\CategoryController@create']);
    Route::post('/category/store', ['as' => 'admin.category.store', 'uses' => 'Backend\CategoryController@store']);
    Route::get('/category/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'Backend\CategoryController@edit']);
    Route::post('/category/update/{id}', ['as' => 'admin.category.update', 'uses' => 'Backend\CategoryController@update']);
    Route::delete('/category/delete/{id}', ['as' => 'admin.category.destroy', 'uses' => 'Backend\CategoryController@destroy']);

    /* Quản lý sản phẩm */
    Route::get('/product', ['as' => 'admin.product.index', 'uses' => 'Backend\ProductController@index']);
    Route::get('/product/create', ['as' => 'admin.product.create', 'uses' => 'Backend\ProductController@create']);
    Route::post('/product/store', ['as' => 'admin.product.store', 'uses' => 'Backend\ProductController@store']);
    Route::get('/product/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'Backend\ProductController@edit']);
    Route::post('/product/update/{id}', ['as' => 'admin.product.update', 'uses' => 'Backend\ProductController@update']);
    Route::delete('/product/delete/{id}', ['as' => 'admin.product.destroy', 'uses' => 'Backend\ProductController@destroy']);
 /* Quản lý size */
    Route::get('/size', ['as' => 'admin.size.index', 'uses' => 'Backend\SizeController@index']);
    Route::get('/size/create', ['as' => 'admin.size.create', 'uses' => 'Backend\SizeController@create']);
    Route::post('/size/store', ['as' => 'admin.size.store', 'uses' => 'Backend\SizeController@store']);
    Route::get('/size/edit/{id}', ['as' => 'admin.size.edit', 'uses' => 'Backend\SizeController@edit']);
    Route::post('/size/update/{id}', ['as' => 'admin.size.update', 'uses' => 'Backend\SizeController@update']);
    Route::delete('/size/delete/{id}', ['as' => 'admin.size.destroy', 'uses' => 'Backend\SizeController@destroy']);
 /* Quản lý menu */
    Route::get('/menu', ['as' => 'admin.menu.index', 'uses' => 'Backend\MenuController@index']);
    Route::get('/menu/create', ['as' => 'admin.menu.create', 'uses' => 'Backend\MenuController@create']);
    Route::post('/menu/store', ['as' => 'admin.menu.store', 'uses' => 'Backend\MenuController@store']);
    Route::get('/menu/edit/{id}', ['as' => 'admin.menu.edit', 'uses' => 'Backend\MenuController@edit']);
    Route::post('/menu/update/{id}', ['as' => 'admin.menu.update', 'uses' => 'Backend\MenuController@update']);
    Route::delete('/menu/delete/{id}', ['as' => 'admin.menu.destroy', 'uses' => 'Backend\MenuController@destroy']);

    /* Quản lý sản phẩm */
    Route::get('/page', ['as' => 'admin.page.index', 'uses' => 'Backend\PageController@index']);
    Route::get('/page/create', ['as' => 'admin.page.create', 'uses' => 'Backend\PageController@create']);
    Route::post('/page/store', ['as' => 'admin.page.store', 'uses' => 'Backend\PageController@store']);
    Route::get('/page/edit/{id}', ['as' => 'admin.page.edit', 'uses' => 'Backend\PageController@edit']);
    Route::post('/page/update/{id}', ['as' => 'admin.page.update', 'uses' => 'Backend\PageController@update']);
    Route::delete('/page/delete/{id}', ['as' => 'admin.page.destroy', 'uses' => 'Backend\PageController@destroy']);
    /* Quản lý sản phẩm */
    Route::get('/body', ['as' => 'admin.body.index', 'uses' => 'Backend\BodyController@index']);
    Route::get('/body/create', ['as' => 'admin.body.create', 'uses' => 'Backend\BodyController@create']);
    Route::post('/body/store', ['as' => 'admin.body.store', 'uses' => 'Backend\BodyController@store']);
    Route::get('/body/edit/{id}', ['as' => 'admin.body.edit', 'uses' => 'Backend\BodyController@edit']);
    Route::post('/body/update/{id}', ['as' => 'admin.body.update', 'uses' => 'Backend\BodyController@update']);
    Route::delete('/body/delete/{id}', ['as' => 'admin.body.destroy', 'uses' => 'Backend\BodyController@destroy']);

    /* Quản lý sản phẩm */
    Route::get('/block', ['as' => 'admin.block.index', 'uses' => 'Backend\BlockController@index']);
    Route::get('/block/create', ['as' => 'admin.block.create', 'uses' => 'Backend\BlockController@create']);
    Route::post('/block/store', ['as' => 'admin.block.store', 'uses' => 'Backend\BlockController@store']);
    Route::get('/block/edit/{id}', ['as' => 'admin.block.edit', 'uses' => 'Backend\BlockController@edit']);
    Route::post('/block/update/{id}', ['as' => 'admin.block.update', 'uses' => 'Backend\BlockController@update']);
    Route::delete('/block/delete/{id}', ['as' => 'admin.block.destroy', 'uses' => 'Backend\BlockController@destroy']);


    //    Quản lý vai trò
    Route::get('/role', ['as' => 'admin.role.index', 'uses' => 'Backend\RoleController@index']);
    Route::get('/role/create', ['as' => 'admin.role.create', 'uses' => 'Backend\RoleController@create']);
    Route::post('/role/store', ['as' => 'admin.role.store', 'uses' => 'Backend\RoleController@store']);
    Route::get('/role/edit/{id}', ['as' => 'admin.role.edit', 'uses' => 'Backend\RoleController@edit']);
    Route::post('/role/update/{id}', ['as' => 'admin.role.update', 'uses' => 'Backend\RoleController@update']);
    Route::get('/role/delete/{id}', ['as' => 'admin.role.destroy', 'uses' => 'Backend\RoleController@destroy']);
    Route::post('/role/{id}/toggleGroup', ['as' => 'admin.role.toggleGroup', 'uses' => 'Backend\RoleController@toggleGroup']);

    // Đơn hàng
    Route::get('/order', ['as' => 'admin.order.index', 'uses' => 'Backend\OrderController@index']);
    Route::get('/order/create', ['as' => 'admin.order.create', 'uses' => 'Backend\OrderController@create']);
    Route::post('/order/store', ['as' => 'admin.order.store', 'uses' => 'Backend\OrderController@store']);
    Route::get('/order/edit/{id}', ['as' => 'admin.order.edit', 'uses' => 'Backend\OrderController@edit']);
    Route::post('/order/update/{id}', ['as' => 'admin.order.update', 'uses' => 'Backend\OrderController@update']);
    Route::delete('/order/delete/{id}', ['as' => 'admin.order.destroy', 'uses' => 'Backend\OrderController@destroy']);
    Route::get('/order/view/{id}', ['as' => 'admin.order.view', 'uses' => 'Backend\OrderController@show']);


    Route::get('/purchase', ['as' => 'admin.purchase.index', 'uses' => 'Backend\BackendController@purchase']);
    Route::get('/customerMenu', ['as' => 'admin.customerMenu.index', 'uses' => 'Backend\BackendController@customerMenu']);
    Route::get('/orderMenu', ['as' => 'admin.orderMenu.index', 'uses' => 'Backend\BackendController@orderMenu']);
    Route::get('/stockMenu', ['as' => 'admin.stockMenu.index', 'uses' => 'Backend\BackendController@stockMenu']);

    Route::get('/template_setting', ['as' => 'admin.template_setting.index', 'uses' => 'Backend\TemplateSettingController@index']);
    Route::get('/template_setting/create', ['as' => 'admin.template_setting.create', 'uses' => 'Backend\TemplateSettingController@create']);
    Route::post('/template_setting/store', ['as' => 'admin.template_setting.store', 'uses' => 'Backend\TemplateSettingController@store']);

});
Route::get('/{alias}', ['as' => 'home.index', 'uses' => 'Frontend\FrontendController@index']);
