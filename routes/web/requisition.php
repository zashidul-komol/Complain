<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

/*====================Ajax part start==============*/
Route::middleware('auth')->group(function () {
    Route::get('get-shops/{param?}', [AjaxController::class, 'getShopsWithPaginate'])->name('ajax.shops.get');
    Route::get('get-shop-details/{param}', [AjaxController::class, 'getShopDetails'])->name('ajax.shops.details');
    Route::get('get-shop-compare-details/{returnId}', [AjaxController::class, 'getShopCompareDetails'])->name('ajax.shops.compare.details');
    Route::get('get-distributor', [AjaxController::class, 'getDistributorsWithPaginate'])->name('ajax.distributors.get');
    Route::get('get-distributor-details/{param}', [AjaxController::class, 'getDistributorDetails'])->name('ajax.distributor.details');
    Route::get('get-requisition-details/{param}', [AjaxController::class, 'getRequisitionDetails'])->name('ajax.requisition.details');
    // Route::get('check-requisition-status', [AjaxController::class, 'checkRequisitionStatus'])->name('ajax.checkRequisitionStatus');
    Route::get('get-transaction-id', [AjaxController::class, 'getTransactionId'])->name('ajax.getTransactionId');
    Route::any('put-transaction-id', [AjaxController::class, 'putTransactionId'])->name('ajax.putTransactionId');
    Route::get('user-depot-shops', [AjaxController::class, 'getShops'])->name('ajax.getShops');
    Route::post('get-depot-distributor', [AjaxController::class, 'getDepotDistributor'])->name('ajax.shops.getDepotDistributor');
    Route::get('get-depot-item-brand', [AjaxController::class, 'getDepotItemBrand'])->name('ajax.shops.getDepotItemBrand');
    Route::get('get-return-df-sizes', [AjaxController::class, 'getReturnDFSizes'])->name('ajax.getReturnDFSizes');
    Route::get('check-available-stock', [AjaxController::class, 'checkStock'])->name('ajax.checkStock');
    Route::get('get-current-dfs', [AjaxController::class, 'getCurrentDfs'])->name('ajax.getCurrentDfs');
    Route::get('get-return-df', [AjaxController::class, 'getReturnDF'])->name('ajax.getReturnDF');
    Route::get('get-all-documents', [AjaxController::class, 'getAllDocuments'])->name('ajax.getAllDocuments');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::middleware(['auth', 'auth.access'])->group(function () {
    // Add your secured permission routes here
});
/*====================Permission part end==============*/
