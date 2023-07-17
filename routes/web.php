<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Admin_Role_Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BloodController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\frontEndController;
use App\Http\Controllers\Admin\DonationInfoController;
use App\Http\Controllers\Admin\DonorInfoController;
use App\Http\Controllers\HomeController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});



// Route::get('/a', function () {
//     return view('front_end.app.app');
// })->name('front_end');


Route::get('/a', function () {
    return view('front_end.app.home');
})->name('front_end');




Route::get('/data/{id)', function () {
    return redirect()->route('home')->with('success', "Thanks! Patient will connect to you very soon");
})->name('donation_accept');

Route::get('/data/reject/{id)', function () {
    return back()->with('error', "Sorry! Please login first to accept");
})->name('donation_reject');








Route::get('/email', function(){
    return view('emails.auth.registrationMail');
})->name('email');



Auth::routes();

Route::get('/', [App\Http\Controllers\frontEndController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\frontEndController::class, 'index'])->name('home');


Route::get('admin/home', [HomeController::class, 'index'])
        ->name('admin.home')
        ->middleware('Is_Admin','auth');


Route::any('list',  [App\Http\Controllers\DonorController::class, 'donor_list_view'])->name('donor_list_view');
Route::any('/filer/list',  [App\Http\Controllers\DonorController::class, 'filter_donor'])->name('filter_donor');
Route::any('/search/list',  [App\Http\Controllers\DonorController::class, 'search_donor'])->name('search_donor');



Route::controller(HomeController::class)
    ->prefix('user/profile')
    ->middleware('auth')
    ->group(function(){



    Route::any('information/{id}', 'profile_view')->name('profile_view');
    Route::any('information/update/{id}', 'profile_update')->name('profile_update');
    Route::post('information/update/post/{id}', 'profile_update_post')->name('profile_update_post');
    

    });



        
// Route::get('dummy', function(){
//     return view('emails.temp.template');
// })->name('dummy');





Route::controller(BloodRequestController::class)
    ->prefix('blood/require')
    ->group(function(){

    Route::any('form','index')->name('blood_req_form')->middleware('auth','Is_Verified');
    Route::post('request/post/send/','request_post')->middleware('auth','Is_Verified')->name('request_post');
    
    Route::any('/data','req_list')->name('data');
    Route::any('/filer/list', 'filter_bld_req')->name('filter_bld_req');
    Route::any('/search/list', 'search_request')->name('search_request');
    
    Route::any('post/upadate/info/{rq_id}', 'b_req_update_info')->name('b_req_update_info');
    Route::get('post/donation/completed/{req_id}', 'donation_complete')->name('donation_complete');
    
    // ajax request to get city list
    Route::post('/get/city/list', 'get_city_list')->name('get_city');
    
});



Route::controller(Admin_Role_Controller::class)
    ->prefix('admin/role/')
    ->middleware(['Is_Admin','auth'])
    ->group(function(){


    Route::any('setting','role_setting')->name('role_setting');   
    Route::any('setting/add/new/role','role_add')->name('role_submit'); 
    Route::any('setting/del/role/{id}','role_del')->name('role_del');


    Route::any('manage','index')->name('role_manage');
    Route::any('search/for/user','search_role')->name('role_manage_search');


});

Route::controller(AdminController::class)
    ->prefix('admin/')
    ->middleware(['Is_Admin','auth'])
    ->group(function(){

    Route::any('setting/add/new/admin/{admin_id}','admin_add')->name('admin_add');
});


Route::controller(BloodController::class)
    ->prefix('admin/blood')
    ->middleware(['Is_Admin','auth'])
    ->group(function(){

    Route::any('collection/list','index')->name('blood_list');
    Route::any('add/blood/group/to/list','blood_group_submit')->name('blood_group_submit');
    Route::any('delete/{id}', 'blood_del')->name('blood_del');


    Route::any('element/collection/list','blood_element')->name('blood_element');
    Route::any('add/blood/element/to/list','blood_element_submit')->name('blood_element_submit');
    Route::get('delete/{id}','element_del')->name('element_del');
});



Route::controller(DonorInfoController::class)
    ->prefix('admin/donor/info')
    ->middleware(['Is_Admin','auth'])
    ->group(function(){

    Route::any('view','index')->name('donor_list');
    Route::any('donation/data/view','donation_info')->name('donation_list');

    Route::get('details/data/view/{id}','donor_details_info')->name('donor_details_info');

    Route::get('donation/details/data/view/{id}','donation_details_info')->name('donation_details_info');    
    
});


Route::controller(DonationInfoController::class)
    ->prefix('admin/donor/info')
    ->middleware(['Is_Admin','auth'])
    ->group(function(){

    Route::get('donation/details/data/view/{id}','donation_details_info')->name('donation_details_info');    
    
});
