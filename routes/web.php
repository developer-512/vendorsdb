<?php

use App\Models\User;
use App\Models\Vendors;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VendorsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RFQController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|E:\laragon\www\attendance-portal\routes\web.php
*/
//Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
//  Route::get('/', [AdminController::class,'index'])->name('dashboard');
//  Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard');
//});
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/storage-link', function () {
Artisan::call('storage:link');
});
    Route::get('/', [VendorsController::class,'dashboard'])->name('dashboard');
    Route::get('/dashboard', [VendorsController::class,'dashboard'])->name('dashboard');
    Route::group(['middleware' => 'can:user_access'], function(){
        Route::resource('users', \App\Http\Controllers\UsersController::class);
        Route::resource('permission', \App\Http\Controllers\PermissionController::class);
        Route::resource('role', \App\Http\Controllers\RoleController::class);
    });
        Route::resource('categories',CategoryController::class);
        //vendors routes
        Route::resource('vendors',VendorsController::class);
        Route::post('vendors/ajax',[VendorsController::class,'active_approval'])->name('vendors.ajax');
        Route::post('vendors/massdelete',[VendorsController::class,'massDestroy'])->name('vendors.massdelete');
        Route::post('vendors/massExport',[VendorsController::class,'massExport'])->name('vendors.massExport');
        Route::get('exportexcel',[VendorsController::class,'exportexcel'])->name('vendors.exportexcel');
        Route::post('importExcel', [VendorsController::class, 'importExcel'])->name('importExcel');
        //request_for_quotation routes
        Route::resource('request_for_quotation',RFQController::class);
        Route::post('request_for_quotation/ajax',[RFQController::class,'active_approval'])->name('request_for_quotation.massdelete');
        Route::get('request_for_quotation/send/{rfq}',[RFQController::class,'send'])->name('request_for_quotation.send');
        Route::post('request_for_quotation/massdelete',[RFQController::class,'massDestroy'])->name('request_for_quotation.massdelete');
        Route::view('/file-manager', 'filemanager')->name('file_manager');
});

Route::group(['middleware' => ['signed']], function () {
    Route::get('rfq-reply/{rfq}', function (\App\Models\RFQ $rfq,\Illuminate\Http\Request $request) {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
//        $vendor=\App\Models\Vendors::find($vendor);
        $vendors=Vendors::all()->pluck('company_name','id');
        $users=User::all()->pluck('name','id');
        $replies=\App\Models\RFQReply::where('rfq_id',$rfq->id)->orderBy('id','desc')->get();
        return view('rfq.reply', compact('rfq','users','vendors','replies'));
    })->name('rfq-reply');
    Route::post('request-for-quotation/{rfq}/reply',[RFQController::class,'rfqReply'])->name('request_for_quotation.rfqReply');
    Route::get('thank-you/{rfq?}', function ($rfq){
        return view('thank-you',compact('rfq'));
    })->name('thank-you');
    //Route::post('dropzone/store/{rfq_id}', 'RFQController@dropzoneStore')->name('dropzone.store');
});
Route::group(['prefix' => 'filemanager', 'middleware' => ['auth:sanctum', 'verified']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

