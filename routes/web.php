<?php

use App\Http\Controllers\AddRoomController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ChargesController;
use App\Http\Controllers\admin\roomController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoomReportsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return view('login');
})->name('login.form');


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', [LoginController::class, 'homepage'])->name('homepage');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::post('storeEmployee', [EmployeeController::class, 'storeEmployee'])->name('storeEmployee');
Route::get('employee_list', [EmployeeController::class, 'employee_list'])->name('employee_list');
Route::post('EditModal', [EmployeeController::class, 'EditModal'])->name('EditModal');
Route::post('updateTableModal', [EmployeeController::class, 'updateTableModal'])->name('updateTableModal');
Route::get('AddNewRoomPage', [AddRoomController::class, 'AddNewRoomPage'])->name('AddNewRoomPage');
Route::post('storeRoom', [AddRoomController::class, 'storeRoom'])->name('storeRoom');
Route::get('room_list', [AddRoomController::class, 'room_list'])->name('room_list');
Route::post('EditRoom', [AddRoomController::class, 'EditRoom'])->name('EditRoom');
Route::post('updateRoomModal', [AddRoomController::class,'updateRoomModal'])->name('updateRoomModal');
Route::get('CheckInPage', [CheckInController::class, 'CheckInPage'])->name('CheckInPage');
Route::post('storeTransaction', [CheckInController::class, 'storeTransaction'])->name('storeTransaction');
Route::get('/search-customers', [CheckInController::class, 'searchCustomers'])->name('searchCustomers');
Route::get('checkin_list', [CheckInController::class ,'checkin_list'])->name('checkin_list');
Route::get('admin_page', [AdminController::class, 'admin_page'])->name('admin_page');
Route::get('charges_page', [ChargesController::class, 'charges_page'])->name('charges_page');
Route::post('storeCategory', [ChargesController::class, 'storeCategory'])->name('storeCategory');
Route::post('storeNewCharges', [ChargesController::class,'storeNewCharges'])->name('storeNewCharges');
Route::get('get_charge_type', [ChargesController::class, 'get_charge_type'])->name('get_charge_type');
Route::get('room_page', [roomController::class, 'room_page'])->name('room_page');
Route::post('storeDiscount', [ChargesController::class, 'storeDiscount'])->name('storeDiscount');
Route::get('get_discount_list',[ChargesController::class, 'get_discount_list'])->name('get_discount_list');
Route::post('viewCheckinModal', [CheckInController::class, 'viewCheckinModal'])->name('viewCheckinModal');
Route::post('EditCheckIn', [CheckInController::class,'EditCheckIn'])->name('EditCheckIn');
Route::post('UpdateCheckIn', [CheckInController::class,'UpdateCheckIn'])->name('UpdateCheckIn');
Route::post('deleteCheckIn', [CheckInController::class, 'deleteCheckIn'])->name('deleteCheckIn');
Route::get('get_reservationList', [CheckInController::class, 'get_reservationList'])->name('get_reservationList');
Route::post('storeOtherchargesEdit', [CheckInController::class, 'storeOtherchargesEdit'])->name('storeOtherchargesEdit');
Route::post('viewCheckOutModal', [CheckInController::class, 'viewCheckOutModal'])->name('viewCheckOutModal');
Route::post('storeCheckout',[CheckInController::class,'storeCheckout'])->name('storeCheckout');
Route::post('CheckInFromReservation', [CheckInController::class,'CheckInFromReservation'])->name('CheckInFromReservation');
Route::post('storeCheckInFromReservation',[CheckInController::class,'storeCheckInFromReservation'])->name('storeCheckInFromReservation');
Route::post('deleteReservation', [CheckInController::class,'deleteReservation'])->name('deleteReservation');
Route::get('get_CheckoutList', [CheckInController::class,'get_CheckoutList'])->name('get_CheckoutList');
Route::post('deleteRoom', [AddRoomController::class, 'deleteRoom'])->name('deleteRoom');
Route::get('RoomTypePage', [AddRoomController::class,'RoomTypePage'])->name('RoomTypePage');
Route::get('get_room_typeList',[AddRoomController::class,'get_room_typeList'])->name('get_room_typeList');
Route::post('EditRoomRate_Modal', [AddRoomController::class, 'EditRoomRate_Modal'])->name('EditRoomRate_Modal');
Route::post('UpdateRoomRate_Modal', [AddRoomController::class, 'UpdateRoomRate_Modal'])->name('UpdateRoomRate_Modal');
Route::post('storeRoomType', [AddRoomController::class, 'storeRoomType'])->name('storeRoomType');
Route::post('deleteRoomType', [AddRoomController::class,'deleteRoomType'])->name('deleteRoomType');
Route::get('get_CompanyList', [AddRoomController::class, 'get_CompanyList'])->name('get_CompanyList');
Route::post('storeCompany', [AddRoomController::class,'storeCompany'])->name('storeCompany');
Route::post('deleteCompany', [AddRoomController::class,'deleteCompany'])->name('deleteCompany');
Route::post('EditCompany_Modal', [AddRoomController::class,'EditCompany_Modal'])->name('EditCompany_Modal');
Route::post('UpdateCompany_Modal', [AddRoomController::class,'UpdateCompany_Modal'])->name('UpdateCompany_Modal');
Route::get('CustomerPage', [AddRoomController::class,'CustomerPage'])->name('CustomerPage');
Route::get('get_CustomerList', [AddRoomController::class,'get_CustomerList'])->name('get_CustomerList');
Route::post('storeCustomer', [AddRoomController::class,'storeCustomer'])->name('storeCustomer');
Route::post('deleteCustomer', [AddRoomController::class,'deleteCustomer'])->name('deleteCustomer');
Route::post('EditCustomer_Modal',[AddRoomController::class,'EditCustomer_Modal'])->name('EditCustomer_Modal');
Route::post('UpdateCustomer_Modal',[AddRoomController::class,'UpdateCustomer_Modal'])->name('UpdateCustomer_Modal');
Route::get('RoomReportsPage', [RoomReportsController::class, 'RoomReportsPage'])->name('RoomReportsPage');
Route::get('calendarPage', [CalendarController::class,'calendarPage'])->name('calendarPage');
Route::get('getTransactions',[CalendarController::class,'getTransactions'])->name('getTransactions');
Route::get('ViewCalendarModal',[CalendarController::class,'ViewCalendarModal'])->name('ViewCalendarModal');
Route::post('EditChargeAdmin', [ChargesController::class,'EditChargeAdmin'])->name('EditChargeAdmin');
Route::post('UpdateChargeAdmin',[ChargesController::class,'UpdateChargeAdmin'])->name('UpdateChargeAdmin');
Route::post('deleteChargeType',[ChargesController::class,'deleteChargeType'])->name('deleteChargeType');
Route::post('EditDiscountAdmin', [ChargesController::class,'EditDiscountAdmin'])->name('EditDiscountAdmin');
Route::post('UpdateDiscountAdmin',[ChargesController::class,'UpdateDiscountAdmin'])->name('UpdateDiscountAdmin');
Route::post('deleteAdminDiscount',[ChargesController::class,'deleteAdminDiscount'])->name('deleteAdminDiscount');
Route::post('EditCheckOut', [CheckInController::class,'EditCheckOut'])->name('EditCheckOut');
Route::post('UpdateCheckOut', [CheckInController::class,'UpdateCheckOut'])->name('UpdateCheckOut');
Route::get('getOverdueCheckouts',[NotificationController::class,'getOverdueCheckouts'])->name('getOverdueCheckouts');
Route::get('getOverdueReservations', [NotificationController::class,'getOverdueReservations'])->name('getOverdueReservations');
Route::post('deleteCheckout',[CheckInController::class,'deleteCheckout'])->name('deleteCheckout');