<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('get-items-for-service', 'AjaxController@getItemsForService')->name('ajax.items.serviceIndex');
    Route::get('get-items-for-service-history', 'AjaxController@getItemsForServiceHistory')->name('ajax.items.serviceHistory');
    //problem entry form open with item detils
    Route::get('get-item-details', 'AjaxController@getItemDetailsBySeraial')->name('ajax.items.getItemDetailsBySeraial');
    Route::get('get-problem-entries/{param}', 'AjaxController@getProblemEntries')->name('ajax.problemEntries.get');
    Route::get('get-problem-details/{param}', 'AjaxController@getProblemDetails')->name('ajax.problemDetails.get');
    Route::get('get-application-details/{param}', 'AjaxController@getApplicationDetails')->name('ajax.applicationDetails.get');
    Route::post('save-application-stage-action', 'AjaxController@saveApplicationStageAction')->name('ajax.applicationStageAction.post');
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
    
});
/*====================Permission part end==============*/

?>