<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');  // 勤怠打刻ページ
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clock_in'); // 出勤打刻
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock_out'); // 退勤打刻
    Route::post('/attendance/reset', [AttendanceController::class, 'reset'])->name('attendance.reset'); //リセット
});


Route::middleware(['auth'])->group(function () {
    // 打刻ページ
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

    // 管理者ルート
    Route::middleware(['role:管理者'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
});

// Route::middleware(['auth', 'role:管理者'])->group(function () {
//     Route::post('/users/{user}/assign-admin', [UserController::class, 'assignAdminRole'])->name('users.assignAdmin');
// });


// Route::middleware(['auth', 'role:管理者'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');
//     Route::delete('/users/{user}', [UserController::class, 'deleteUser'])->name('users.delete');
// });
