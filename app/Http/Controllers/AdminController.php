<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Adminユーザーのログイン処理
     * @param Illuminate\Http\Request
     */
    function login(Request $request)
    {
        // 内容の確認
        $admin_id = $request->input('admin_id');
        $password = $request->input('password');

        if ($admin_id == config('admin.admin_id') && $password == config('admin.admin_pass')) {
            // ログインの成功
            $request->session()->put("admin_auth", true);
            return redirect()->route("admin.home");
        }

        // ログイン失敗
        // return back()->withErrors([
        //     'danger' => '管理者IDもしくはパスワードが間違っています。',
        // ]);
    }

    /**
     * Adminユーザーをアプリケーションからログアウトさせる
     *
     * @param  \Illuminate\Http\Request $request
     */
    function logout(Request $request)
    {
        $request->session()->forget("admin_auth");

        return redirect()->route('admin.showLogin');
    }

}
