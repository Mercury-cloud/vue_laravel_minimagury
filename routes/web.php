<?php

use App\Http\Controllers\Manage\AuthController;
use App\Http\Controllers\Manage\UserController;
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
/*******
 * フロント
 */

/**********
* 管理画面
***********/ 
Route::name('manage.')->group(function () {
    Route::get('/manage/login',         [AuthController::class, 'login'])->name('login');
    Route::post('/manage/login',        [AuthController::class, 'loginAttempt'])->name('login.attempt');
    
    Route::middleware(['auth:admin'])->group(function() {
        Route::get('/manage/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/manage',                   [AuthController::class, 'index'])->name('index');
        Route::get('/manage/user',              [UserController::class, 'index'])->name('user.index');
        Route::get('/manage/user/add',          [UserController::class, 'add'])->name('user.add');
        Route::post('/manage/user/add',         [UserController::class, 'store'])->name('user.add.post');
        Route::get('/manage/user/edit/{user}',  [UserController::class, 'edit'])->name('user.edit');
        Route::post('/manage/user/edit/{user}', [UserController::class, 'store'])->name('user.edit.post');
        Route::get('/manage/user/delete/{user}',[UserController::class, 'delete'])->name('user.delete');
    });
});

