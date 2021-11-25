<?php

use App\Http\Controllers\Manage\AuthController;
use Illuminate\Support\Facades\Route;

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

/**********
* 管理画面
***********/ 

Route::get('/login',      [AuthController::class, 'login'])->name('manage.login');
Route::get('/user',      [AuthController::class, 'user'])->name('manage.user');
Route::get('/user/add',      [AuthController::class, 'useradd'])->name('manage.user.add');
Route::get('/manage/logout',      [AuthController::class, 'logout'])->name('manage.logout');