<?php
/*====================Ajax part start==============*/
Route::group(['middleware' => 'auth'], function () {
	
});
/*====================Ajax part end==============*/

/*====================Permission part start==============*/
Route::group(['middleware' => ['auth', 'auth.access']], function () {
	
});
/*====================Permission part end==============*/

?>