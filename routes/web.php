<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
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
    return redirect('/login');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user','middleware' => ['auth','checkRole']],function(){
    Route::get('dashboard',[UserController::class,'dashboard'])->name('user_dashboard');
    Route::get('booking_room',[UserController::class,'showBookingPage'])->name('user_booking_room');
    Route::get('room_list',[UserController::class,'showRoomListPage'])->name('show_room_list');
    Route::get('booking_history',[UserController::class,'showBookingHistoryPage'])->name('show_booking_history');

    Route::post('s_availroom',[UserController::class,'searchAvailRoom']);
    Route::get('info_room',[UserController::class,'getRoomInfo']);
    Route::get('info_book',[UserController::class,'getBookInfo']);
    Route::post('book',[UserController::class,'bookRoom']);
    Route::post('cancel',[UserController::class,'cancelBook']);
});

Route::group(['prefix' => 'fed','middleware' => ['auth','checkRole']],function(){
    Route::get('dashboard',[AdminController::class,'fed_dashboard'])->name('fed_dashboard');
    Route::get('attendance',[AdminController::class,'attendancePage'])->name('attendance');
    Route::get('room_management',[AdminController::class,'roomManagementPage'])->name('room_management');

    Route::post('add_att',[AdminController::class,'addAttendance']);
    Route::post('edit_att',[AdminController::class,'editAttendance']);
    Route::get('info_att',[AdminController::class,'infoAttendance']);
    Route::get('acc_book/{id}',[AdminController::class,'acceptBook']);
    Route::get('ccl_book/{id}',[AdminController::class,'cancelBook']);
});

Route::group(['prefix' => 'ssc','middleware' => ['auth','checkRole']],function(){
    Route::get('dashboard',[AdminController::class,'ssc_dashboard'])->name('ssc_dashboard');
    Route::get('item_management',[AdminController::class,'itemManagement'])->name('item_management');
    Route::get('item_history',[AdminController::class,'itemHistory'])->name('item_history');
    Route::get('item_list',[AdminController::class,'showItemList'])->name('item_list');
    Route::get('request_list',[AdminController::class,'requestItemList'])->name('request_list');

});

Route::get('changepass',[HomeController::class,'cpPage'])->name('c_p');
Route::post('com_cp',[HomeController::class,'confirmChange']);

Route::group(['prefix' => 'sa','middleware' => ['auth','checkRole']],function(){
    Route::get('dashboard',[AdminController::class,'sa_dashboard'])->name('sa_dashboard');
    
    Route::post('add_admin',[AdminController::class,'add_admin']);
});
