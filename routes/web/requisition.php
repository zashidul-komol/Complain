<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
	Route::get('get-shops/{param?}', 'AjaxController@getShopsWithPaginate')->name('ajax.shops.get');
	Route::get('get-shop-details/{param}', 'AjaxController@getShopDetails')->name('ajax.shops.details');
	Route::get('get-shop-compare-details/{returnId}', 'AjaxController@getShopCompareDetails')->name('ajax.shops.details');
	Route::get('get-distributor', 'AjaxController@getDistributorsWithPaginate')->name('ajax.distributors.get');
	Route::get('get-distributor-details/{param}', 'AjaxController@getDistributorDetails')->name('ajax.distributor.details');
	Route::get('get-requisition-details/{param}', 'AjaxController@getRequisitionDetails')->name('ajax.requisition.details');
	// Route::get('check-requisition-status', 'AjaxController@checkRequisitionStatus')->name('ajax.checkRequisitionStatus');
	Route::get('get-transaction-id', 'AjaxController@getTransactionId')->name('ajax.getTransactionId');
	Route::any('put-transaction-id', 'AjaxController@putTransactionId')->name('ajax.putTransactionId');
	Route::get('user-depot-shops', 'AjaxController@getShops')->name('ajax.getShops');
	Route::post('get-depot-distributor', 'AjaxController@getDepotDistributor')->name('ajax.shops.getDepotDistributor');
	Route::get('get-depot-item-brand', 'AjaxController@getDepotItemBrand')->name('ajax.shops.getDepotItemBrand');
	Route::get('get-return-df-sizes', 'AjaxController@getReturnDFSizes')->name('ajax.getReturnDFSizes');
	Route::get('check-available-stock', 'AjaxController@checkStock')->name('ajax.checkStock');
	Route::get('get-current-dfs', 'AjaxController@getCurrentDfs')->name('ajax.getCurrentDfs');
	Route::get('get-return-df', 'AjaxController@getReturnDF')->name('ajax.getReturnDF');
	Route::get('get-all-documents', 'AjaxController@getAllDocuments')->name('ajax.getAllDocuments');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
	

	
});
/*====================Permission part end==============*/
?>