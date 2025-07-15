<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
	Route::get('get-stocks', 'AjaxController@getStocks')->name('ajax.stocks.get');
	Route::get('get-stock-details/{param}', 'AjaxController@getStockDetails')->name('ajax.stocks.details');
	Route::get('get-allocation-details/{param}', 'AjaxController@getAllocationDetails')->name('ajax.allocation.details');
	Route::get('allocation-receive/{param}', 'AjaxController@depotStockAccept')->name('ajax.allocation.receive');
	Route::get('get-allocations', 'AjaxController@getAllocations')->name('ajax.allocation.index');
	Route::get('get-depot-allocations/{stockId?}', 'AjaxController@getDepotAllocations')->name('ajax.depotAllocation.index');
	Route::get('get-items/{param}', 'AjaxController@getItems')->name('ajax.items.index');

	Route::get("stock-transfer-show/{stock_transfer_id}", array(
		'uses' => 'AjaxController@stockTransferShow',
		'as' => 'inventories.stockTransferShow',
	));

	Route::get("stock-transfer-edit/{from_depot}/{transfer_id}", array(
		'uses' => 'AjaxController@stockTransferEdit',
		'as' => 'inventories.stockTransferEdit',
	));
	Route::get("get-df-code-lists", array(
		'uses' => 'AjaxController@dfcodeLists',
		'as' => 'ajax.inventories.dfcodeLists',
	));
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
	

    /*============Customer Complain Type start here========================*/
	
    Route::resource('complainTypes', 'CustomerComplainTypesController',
        ['except' => ['show']]);
    
    Route::get('complainTypes/download', [
        'as' => 'complainTypes.download',
        'uses' => 'CustomerComplainTypesController@download',
    ]);

   /*============Customer Complain Type end here========================*/

   /*============Customer Complain start here========================*/
	
    Route::resource('customerComplains', 'CustomerComplainsController',
        ['except' => ['show']]);
    
    Route::get('customerComplains/download', [
        'as' => 'customerComplains.download',
        'uses' => 'CustomerComplainsController@download',
    ]);

    Route::get('customerComplains/dashboard', [
        'as' => 'customerComplains.dashboard',
        'uses' => 'CustomerComplainsController@dashboard',
    ]);


    Route::get('customerComplains/view_customer_complain/{param}', [
		'as' => 'customerComplains.viewCustomerComplain',
		'uses' => 'CustomerComplainsController@viewCustomerComplain',
	]);

	Route::get('customerComplains/processing', [
		'as' => 'customerComplains.processing',
		'uses' => 'CustomerComplainsController@processing',
	]);

	Route::get('customerComplains/view_processing/{param}', [
		'as' => 'customerComplains.viewProcessing',
		'uses' => 'CustomerComplainsController@viewProcessing',
	]);

	Route::get('customerComplains/completed', [
		'as' => 'customerComplains.completed',
		'uses' => 'CustomerComplainsController@completed',
	]);

	Route::get('customerComplains/view_completed/{param}', [
		'as' => 'customerComplains.viewCompleted',
		'uses' => 'CustomerComplainsController@viewCompleted',
	]);

	Route::get('customerComplains/customer_complainDowload/{param}', [
		'as' => 'customerComplains.customerComplainDownload',
		'uses' => 'CustomerComplainsController@customerComplainDownload',
	]);

   /*============Customer Complain end here========================*/

   /*============Products Type start here========================*/
    
    Route::resource('products', 'ProductsController',
        ['except' => ['show']]);
    
    Route::get('products/download', [
        'as' => 'products.download',
        'uses' => 'ProductsController@download',
    ]);
    
   /*============Products Type end here========================*/



});
/*====================Permission part end==============*/

?>