<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\OfficeLocationsController;
use App\Http\Controllers\StagingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index']);

    Route::get('dashboard/Job-crud', [HomeController::class, 'store'])
        ->name('dashboards.Job-crud');
    
    Route::get('dashboard/updateEmployee', [HomeController::class, 'index'])
        ->name('dashboards.index');

    Route::post('example', [HomeController::class, 'example'])->name('example');

    // Template pages (remove for production)
    Route::get('pages/{name}', [HomeController::class, 'pages'])->name('template');

    /* ===================== Ajax Routes ================== */
    Route::post('get-district', [AjaxController::class, 'getDistricts']);
    Route::post('get-thanas', [AjaxController::class, 'getThanas']);
    Route::post('get-areas', [AjaxController::class, 'getAreas']);
    Route::get('stage-action-oparation/{id}/{functionName}/{stage}/{module?}', [AjaxController::class, 'stageActionOparation'])
        ->name('ajax.stage.action');
    Route::post('stage-action-oparation-save/{module?}', [AjaxController::class, 'saveStageAction'])
        ->name('ajax.stage.saveAction');

    Route::post('get-multi-district', [AjaxController::class, 'getMultiDistricts'])
        ->name('ajax.getMultiDistricts');
    Route::post('get-multi-thana', [AjaxController::class, 'getMultiThanas'])
        ->name('ajax.getMultiThanas');
    Route::post('get-multi-distributor', [AjaxController::class, 'getMultiDistributor'])
        ->name('ajax.getMultiDistributor');
    Route::post('get-region-wise-depots', [AjaxController::class, 'getRegionWiseDepots'])
        ->name('ajax.getRegionWiseDepots');
    Route::post('get-depot-codes', [AjaxController::class, 'getDepotCodes'])
        ->name('ajax.getDepotCodes');

    Route::get('settlements-ajax/{param}/continue-list', [AjaxController::class, 'continueList'])
        ->name('ajax.settlements.continueList');
    Route::get('settlements-ajax/{param}/closed-list', [AjaxController::class, 'closedList'])
        ->name('ajax.settlements.closedList');

    Route::post('get-multi-technician', [AjaxController::class, 'getMultiTechnician'])
        ->name('ajax.getMultiTechnician');
    Route::post('profile-picture-upload', [AjaxController::class, 'uploadProfilePicture'])
        ->name('ajax.uploadProfilePicture');
    Route::get('get-sms-promotionals/{param?}', [AjaxController::class, 'getPromotionalSmsWithPaginate'])
        ->name('ajax.smsPromotionals.get');
    Route::get('get-distributors', [AjaxController::class, 'getDistributorsWithPaginate'])
        ->name('ajax.distributor.get');
    /* ===================== Ajax Routes End ==================== */
});

Route::get('logout', [LoginController::class, 'logout']);
Auth::routes();



Route::group(['middleware' => ['auth', 'auth.access']], function () {
    Route::resource('site_settings', SiteSettingsController::class)
        ->only(['edit', 'update']);
    
    Route::resource('roles', RolesController::class)
        ->except(['show']);

    /*============== User Routes ==============*/
    Route::get('/users', [RegisterController::class, 'showUserLists'])
        ->name('users.index');
    Route::get('/users/profile/{params?}', [RegisterController::class, 'showUser'])
        ->name('users.show');
    Route::get('/users/{user}/edit', [RegisterController::class, 'editUser'])
        ->name('users.edit');
    Route::put('/users/{user}', [RegisterController::class, 'updateUser'])
        ->name('users.update');
    Route::delete('/users/{user}', [RegisterController::class, 'destroyUser'])
        ->name('users.destroy');
    Route::any('/password/change-user-password/{user}', [RegisterController::class, 'changeUserPassword'])
        ->name('password.changeUserPassword');
    Route::any('/password/change', [RegisterController::class, 'changePassword'])
        ->name('password.change');
    Route::get('/users/list/download', [RegisterController::class, 'download'])
        ->name('users.download');

    /*============== Location Routes ==============*/
    Route::get('locations/{param?}', [LocationsController::class, 'index'])
        ->name('locations.index');
    Route::get('locations/create/{param?}', [LocationsController::class, 'create'])
        ->name('locations.create');
    Route::get('locations/{location}/edit/{param?}', [LocationsController::class, 'edit'])
        ->name('locations.edit');
    Route::get('locations/download/{param}', [LocationsController::class, 'Download'])
        ->name('locations.download');
    Route::resource('locations', LocationsController::class)
        ->except(['index', 'show', 'create', 'edit']);

    /*============ Designation Routes ============*/
    Route::any('designations-sorting', [DesignationsController::class, 'sort'])
        ->name('designations.sort');
    Route::get('designations/download', [DesignationsController::class, 'download'])
        ->name('designations.download');
    Route::resource('designations', DesignationsController::class)
        ->except(['show']);

    /*============ Department Routes ============*/
    Route::resource('departments', DepartmentsController::class)
        ->except(['show']);
    Route::get('departments/download', [DepartmentsController::class, 'download'])
        ->name('departments.download');

    /*============ Office Location Routes ============*/
    Route::resource('officelocations', OfficeLocationsController::class)
        ->except(['show']);
    Route::get('officelocations/download', [OfficeLocationsController::class, 'download'])
        ->name('officelocations.download');

    /*============ Region Routes ============*/
    Route::resource('regions', RegionsController::class)
        ->except(['show']);
    Route::get('regions/download', [RegionsController::class, 'download'])
        ->name('regions.download');

    /*============ Staging Routes ============*/
    Route::get('stages/{modules}', [StagingsController::class, 'index'])
        ->name('stages.index');
    Route::get('stages/{modules}/create', [StagingsController::class, 'create'])
        ->name('stages.create');
    Route::post('stages/{modules}', [StagingsController::class, 'store'])
        ->name('stages.store');
    Route::get('stages/{modules}/edit/{stage}', [StagingsController::class, 'edit'])
        ->name('stages.edit');
    Route::put('stages/{modules}/{stage}', [StagingsController::class, 'update'])
        ->name('stages.update');
    Route::delete('stages/{modules}/{stages}', [StagingsController::class, 'destroy'])
        ->name('stages.destroy');
    Route::delete('stage-untag/{modules}/{stageDetail}/{stage}', [StagingsController::class, 'untag'])
        ->name('stage.details.untag');
    Route::any('stage-sorting/{modules}', [StagingsController::class, 'sort'])
        ->name('stages.sort');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');