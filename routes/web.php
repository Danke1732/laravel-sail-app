<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

// -- 一般ユーザーミドルウェア --
// 一般ユーザーログイン未のミドルウェア
// Route::middleware(['guest'])->group(function () {

// });

// 利回り計算ページ表示
Route::get('/', function () {
    return view('home');
});

// 一般ユーザーログイン済みのミドルウェア
// Route::middleware(['auth'])->group(function () {

// });

//  -- 管理者ユーザーミドルウェア --
// 管理者ユーザーログイン時のミドルウェア
Route::group(['middleware' => ['auth.check']], function () {
    // 管理者ユーザーログインページへ遷移
    Route::get('admin/login', function() {
        return view('admin.admin_login');
    })->name('admin.showLogin');
    // 管理者ユーザーログイン処理
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
});

// 管理者ユーザーログイン未のミドルウェア
Route::group(['middleware' => ['auth.admin']], function () {
    // 管理者画面ホーム
    Route::get('admin/home', function() {
        return view('admin.admin_home');
    })->name('admin.home');
    // 管理者広告一覧表示
    Route::get('admin/ads_list', [AdminController::class, 'ads_list'])->name('admin.ads_list');

    // ads1(上)登録処理
    Route::post('/admin/upload_top', [AdminController::class, 'upload_top'])->name('ads.upload_top');
    // ads2(下)登録処理
    Route::post('/admin/upload_bottom', [AdminController::class, 'upload_bottom'])->name('ads.upload_bottom');

    // 管理者ユーザーログアウト処理
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
