<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chart;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use App\Library\Calculate;
use Carbon\Carbon;

class UsersController extends Controller
{
    /**
     * ユーザー詳細(過去の計算結果一覧)情報を表示
     * @return View
     */
    public function userDetail($id)
    {
        // ランダムな上部広告をViewへ渡す
        $ads_top_lists = Ad::where('location', 0)->get();
        if (!empty($ads_top_lists[0])) {
            $random_key = rand(0, (count($ads_top_lists) - 1));
            $ad_top = $ads_top_lists[$random_key];
        } else {
            $ad_top = null;
        }
        // ランダムな下部広告をViewへ渡す
        $ads_bottom_lists = Ad::where('location', 1)->get();
        if (!empty($ads_bottom_lists[0])) {
            $random_key = rand(0, (count($ads_bottom_lists) - 1));
            $ad_bottom = $ads_bottom_lists[$random_key];
        } else {
            $ad_bottom = null;
        }

        $user = User::find($id);
        if (isset($user)) {
            $auth_user = Auth::user();
            // リクエストユーザーとログインユーザーが一致しているか確認
            if ($user->id === $auth_user->id) {
                // リクエストユーザーの全ての計算シミュレーション結果を取得
                $calculates = Chart::orderBy('id', 'desc')->where('user_id', $user->id)->paginate(12);

                // 各計算結果の配列を代入するための配列を準備
                $result_calculates = [];
                foreach ($calculates as $calculate) {
                    // 必要項目の計算をして結果を一覧に返す！！
                    $calc = new Calculate();
                    $result = $calc->return_calculate($calculate);
                    $date = mb_substr($calculate->updated_at, 0, 10);
                    $result['updated_at'] = new Carbon($date);
                    // 物件価格があれば配列に代入
                    if (!empty($calculate->option['property_name'])) {
                        $result['property_name'] = $calculate->option['property_name'];
                    }
                    // 物件メモがあれば配列に代入
                    if (!empty($calculate->option['note'])) {
                        $result['note'] = $calculate->option['note'];
                    }
                    // 計算表に画像があれば画像パスを配列に代入
                    if (!empty($calculate->chart_images[0])) {
                        $result['image_path'] = $calculate->chart_images[0]['image_path'];
                    }
                    // 情報の最終値をViewへ返す配列へ代入
                    array_push($result_calculates, $result);
                }

                if (empty($result_calculates)) {
                    $result_calculates = null;
                }

                return view('user_detail', ["user" => $user, "result_calculates" => $result_calculates, "ad_top" => $ad_top, "ad_bottom" => $ad_bottom, "calculates" => $calculates]);
            }
        }

        return redirect()->route('calculate')->with('danger', '不正なリクエストが実行されました。');
    }

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
