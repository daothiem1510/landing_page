<?php

Route::group(['middleware' => 'frontend'], function() {
    Route::get('/{alias}', ['as' => 'home.index', 'uses' => 'Frontend\FrontendController@index']);
     /* Sản phẩm */
    Route::get('/sale', ['as' => 'product.sale', 'uses' => 'Frontend\ProductController@sale']);
    Route::get('/san-pham/{alias}', ['as' => 'product.detail', 'uses' => 'Frontend\ProductController@detail']);
});
