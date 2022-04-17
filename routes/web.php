<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\AdminResetPasswordController;
use App\Http\Controllers\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Auth\EmployeeResetPasswordController;
use App\Http\Controllers\Auth\EmployeeForgotPasswordController;

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

Route::get('/', [LoginController::class,'showLoginForm'])  -> middleware('guest');

// Route::get('/home', function () {
//     return view('home');
// }) ;


// Login

Auth::routes();

Route::get('logout',[LoginController::class,'logout']);

Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])  -> middleware('guest');

Route::get('/login/employee', [LoginController::class,'showEmployeeLoginForm'])  -> middleware('guest');


Route::post('/login/admin', [LoginController::class,'adminLogin'])  -> middleware('guest');
Route::post('/login/employee', [LoginController::class,'employeeLogin'])  -> middleware('guest');





//Reset Password Admin

Route::post('/password/emailadmin',[AdminForgotPasswordController::class,'sendResetLinkAdmin'])->name('admin.password.email');
Route::get('/password/resetadmin',[AdminForgotPasswordController::class ,'showLinkRequestForm'])->name('admin.password.request');
Route::post('/password/resetadmin',[AdminResetPasswordController::class,'resetCek']);
Route::get('/password/resetadmin/{token}',[AdminResetPasswordController::class,'showResetForm'])->name('admin.password.reset');

// Reset Password Employee
Route::get('/password/resetemployee',[EmployeeForgotPasswordController::class ,'showLinkRequestForm'])->name('employee.password.request');
Route::post('/password/resetemployee',[EmployeeResetPasswordController::class,'resetCek']);
Route::post('/password/emailemployee',[EmployeeForgotPasswordController::class,'sendResetLinkEmployee'])->name('employee.password.email');
Route::get('/password/resetemployee/{token}',[EmployeeResetPasswordController::class,'showResetForm'])->name('employee.password.reset');

// Reset Password User
Route::get('/password/reset',[ForgotPasswordController::class ,'showLinkRequestForm'])->name('password.request');
Route::post('/password/resetuser',[ResetPasswordController::class,'resetCek']);
Route::post('/password/email',[ForgotPasswordController::class,'sendResetLink'])->name('password.email');
Route::get('/password/resetuser/{token}',[ResetPasswordController::class,'showResetForm'])->name('password.reset');



Route::group(['middleware' => 'auth:'], function () {
    Route::get('/home', [UsersController::class,'index']);
    
    Route::post('/home', [UsersController::class,'inputKonsultasi']);

    Route::get('/konsultasi/user', [UsersController::class,'konsultasi']);

    Route::get('/konsultasi/user/{id}', [UsersController::class,'showById']);

    Route::post('/konsultasi/user/{id}', [UsersController::class,'inputJawaban']);

    Route::post('/selesaikan/{id}', [UsersController::class,'selesaiKonsul']);

    Route::post('/konsultasi/tatapmuka', [UsersController::class,'addTatapMuka']);
    
    Route::get('/tatapmuka/user', [UsersController::class,'tatapMuka']);

    Route::get('/tatapmuka/user/{id}', [UsersController::class,'showById']);

    Route::post('/konsultasi/tatapmuka/ajukanulang/{id}', [UsersController::class,'ajukanUlang']);

    Route::get('/tatapmuka/user/cetaktiket/{id}', [UsersController::class,'cetak']);

    Route::get('/user/account', [UsersController::class,'account']);

    Route::get('/user/account/edit', [UsersController::class,'editProfil']);
    
    Route::post('/user/account/edit', [UsersController::class,'saveProfil']);
    

});

Route::group(['middleware' => 'auth:employee'], function () {

    Route::view('/employee', 'employee/dashboard');

    Route::get('/konsultasi', [EmployeeController::class,'konsultasi']);

    Route::get('/konsultasi/{id}', [EmployeeController::class,'showById']);

    Route::post('/konsultasi/{id}', [EmployeeController::class,'tanggapi']);

    Route::post('/konsultasi/send/{id}', [EmployeeController::class,'inputJawaban']);

    Route::get('/employee/konsul', [EmployeeController::class,'konsultasiByEmp']);

    Route::get('/employee/tatapmuka', [EmployeeController::class,'tatapMuka']);

    Route::post('/employee/tatapmuka/selesesikan', [EmployeeController::class,'selesaikanTM']);
    
    Route::get('employee/tatapmuka/setujui/{id}', [EmployeeController::class,'setujuiTM']);

    Route::get('employee/tatapmuka/ajukan/{id}', [EmployeeController::class,'ajukanTM']);

    Route::get('employee/tatapmuka/{id}', [EmployeeController::class,'showById']);

    Route::get('/employee/account', [EmployeeController::class,'account']);

    Route::get('/employee/account/edit', [EmployeeController::class,'editProfil']);
    
    Route::post('/employee/account/edit', [EmployeeController::class,'saveProfil']);
});



Route::group(['middleware' => 'auth:admin'], function () {
    
    Route::get('/admin', [AdminController::class,'index']);

    Route::get('/admin/users', [AdminController::class,'users']);

    Route::post('/admin/users', [AdminController::class,'tambahPegawai']);

    Route::get('/admin/account', [AdminController::class,'account']);

    Route::get('/admin/laporan', [AdminController::class,'laporan']);

    Route::get('/admin/unit', [AdminController::class,'showUnit']);

    Route::post('/unit/hapus/{id}', [AdminController::class,'delete']);

    Route::post('/unit/tambah', [AdminController::class,'addUnit']);

    Route::get('/admin/users/aktifkan/{id}', [AdminController::class,'aktifkanPegawai']);

    Route::get('/admin/users/suspend/{id}', [AdminController::class,'suspendPegawai']);

    Route::get('/admin/pegawai/detail/{id}', [AdminController::class,'detailPegawai']);

    Route::get('/admin/users/detail/{id}', [AdminController::class,'detailUser']);

    Route::get('/admin/users/hapus/{id}', [AdminController::class,'hapusUser']);

    Route::get('/admin/laporan/reset/{id}', [AdminController::class,'resetLaporan']);

    Route::get('/admin/laporan/{id}', [AdminController::class,'detailLaporan']);

    Route::get('/admin/account/edit', [AdminController::class,'editProfil']);

    Route::post('/admin/account/edit', [AdminController::class,'saveProfil']);

    Route::get('/admin/register/employee', [RegisterController::class,'showEmployeeRegisterForm']) ;

    Route::post('/admin/register/employee', [RegisterController::class,'createEmployee']) ;

});