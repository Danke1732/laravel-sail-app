<?php

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

// 一般ユーザーミドルウェア
Route::get('/', function () {
    return view('home');
});

//  -- 管理者ユーザーミドルウェア --

// 管理者ユーザーログインページへ遷移
Route::get('admin/login', function() {
    return view('admin.admin_login');
});
// 管理者ユーザーログイン処理
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// 管理者画面ホーム
Route::get('admin/home', function() {
    return view('admin.admin_home');
});
// Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
