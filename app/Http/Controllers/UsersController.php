<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * ユーザーの退会処理
     * @param int $id
     * @return view
     */
    function userWithdraw($id)
    {
        $user = User::find($id);
        $auth_user = Auth::user();

        if (empty($user)) {
            return redirect()->route('calculate')->with('danger', '該当のユーザーIDが見つかりませんでした。');
        }

        if ($user->id === $auth_user->id) {
            try {
                User::destroy($user->id);
            } catch(\Throwable $e) {
                return redirect()->route('calculate')->with('danger', '退会処理に失敗しました。');
            }
    
            return redirect()->route('calculate')->with('success', '退会が完了しました。');
        }

        return redirect()->route('calculate')->with('danger', '不正なリクエストが実行されました。');

    }
}
