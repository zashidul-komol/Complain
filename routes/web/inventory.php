<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CustomerComplainTypesController;
use App\Http\Controllers\CustomerComplainsController;
use App\Http\Controllers\ProductsController;

/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('get-stocks', [AjaxController::class, 'getStocks'])->name('ajax.stocks.get');
    Route::get('get-stock-details/{param}', [AjaxController::class, 'getStockDetails'])->name('ajax.stocks.details');
    Route::get('get-allocation-details/{param}', [AjaxController::class, 'getAllocationDetails'])->name('ajax.allocation.details');
    Route::get('allocation-receive/{param}', [AjaxController::class, 'depotStockAccept'])->name('ajax.allocation.receive');
    Route::get('get-allocations', [AjaxController::class, 'getAllocations'])->name('ajax.allocation.index');
    Route::get('get-depot-allocations/{stockId?}', [AjaxController::class, 'getDepotAllocations'])->name('ajax.depotAllocation.index');
    Route::get('get-items/{param}', [AjaxController::class, 'getItems'])->name('ajax.items.index');

    Route::get("stock-transfer-show/{stock_transfer_id}", [AjaxController::class, 'stockTransferShow'])
        ->name('inventories.stockTransferShow');

    Route::get("stock-transfer-edit/{from_depot}/{transfer_id}", [AjaxController::class, 'stockTransferEdit'])
        ->name('inventories.stockTransferEdit');

    Route::get("get-df-code-lists", [AjaxController::class, 'dfcodeLists'])
        ->name('ajax.inventories.dfcodeLists');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
    
    /*============Customer Complain Type start here========================*/
    Route::resource('complainTypes', CustomerComplainTypesController::class)
        ->except(['show']);
    
    Route::get('complainTypes/download', [CustomerComplainTypesController::class, 'download'])
        ->name('complainTypes.download');
    /*============Customer Complain Type end here========================*/

    /*============Customer Complain start here========================*/
    Route::resource('customerComplains', CustomerComplainsController::class)
        ->except(['show']);
    
    Route::get('customerComplains/download', [CustomerComplainsController::class, 'download'])
        ->name('customerComplains.download');

    Route::get('customerComplains/dashboard', [CustomerComplainsController::class, 'dashboard'])
        ->name('customerComplains.dashboard');

    Route::get('customerComplains/view_customer_complain/{param}', [CustomerComplainsController::class, 'viewCustomerComplain'])
        ->name('customerComplains.viewCustomerComplain');

    Route::get('customerComplains/processing', [CustomerComplainsController::class, 'processing'])
        ->name('customerComplains.processing');

    Route::get('customerComplains/notAccepted', [CustomerComplainsController::class, 'notAccepted'])
        ->name('customerComplains.notAccepted');

    Route::get('customerComplains/view_processing/{param}', [CustomerComplainsController::class, 'viewProcessing'])
        ->name('customerComplains.viewProcessing');

    Route::get('customerComplains/completed', [CustomerComplainsController::class, 'completed'])
        ->name('customerComplains.completed');

    Route::get('customerComplains/view_completed/{param}', [CustomerComplainsController::class, 'viewCompleted'])
        ->name('customerComplains.viewCompleted');

    Route::get('customerComplains/customer_complainDowload/{param}', [CustomerComplainsController::class, 'customerComplainDownload'])
        ->name('customerComplains.customerComplainDownload');
    /*============Customer Complain end here========================*/

    /*============Products Type start here========================*/
    Route::resource('products', ProductsController::class)
        ->except(['show']);
    
    Route::get('products/download', [ProductsController::class, 'download'])
        ->name('products.download');
    /*============Products Type end here========================*/
});
/*====================Permission part end==============*/