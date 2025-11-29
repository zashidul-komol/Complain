<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;

/*====================Ajax part start==============*/
Route::middleware('auth')->group(function () {
    Route::get('get-items-for-service', [AjaxController::class, 'getItemsForService'])->name('ajax.items.serviceIndex');
    Route::get('get-items-for-service-history', [AjaxController::class, 'getItemsForServiceHistory'])->name('ajax.items.serviceHistory');

    // Problem entry form open with item details
    Route::get('get-item-details', [AjaxController::class, 'getItemDetailsBySeraial'])->name('ajax.items.getItemDetailsBySeraial');
    Route::get('get-problem-entries/{param}', [AjaxController::class, 'getProblemEntries'])->name('ajax.problemEntries.get');
    Route::get('get-problem-details/{param}', [AjaxController::class, 'getProblemDetails'])->name('ajax.problemDetails.get');
    Route::get('get-application-details/{param}', [AjaxController::class, 'getApplicationDetails'])->name('ajax.applicationDetails.get');
    Route::post('save-application-stage-action', [AjaxController::class, 'saveApplicationStageAction'])->name('ajax.applicationStageAction.post');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::middleware(['auth', 'auth.access'])->group(function () {
    // Add permission-based routes here
});
/*====================Permission part end==============*/
