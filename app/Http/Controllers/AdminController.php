<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdsTopCreateRequest;
use App\Http\Requests\AdsBottomCreateRequest;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

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

    /**
     * 広告一覧表示
     * @return View
     */
    public function ads_list()
    {
        $ads_top_lists = Ad::where('location', 0)->get();
        $ads_bottom_lists = Ad::where('location', 1)->get();
        return view("admin.ads_list", ["ads_top_lists" => $ads_top_lists, "ads_bottom_lists" => $ads_bottom_lists]);
    }

    /**
     * 広告（上）のアップロード処理
     * @param App\Http\Requests\AdsTopCreateRequest $request
     */
    public function upload_top(AdsTopCreateRequest $request)
    {
        // 送られてきたデータを取得
        $inputs = $request->all();
        // 送られてきた画像情報を取得(変数へ代入)
        $upload_image = $request->input('image1');
        // Adインスタンスの作成
        $ad = new Ad();
       
        // 画像が存在すれば条件分岐
        if ($upload_image) {
            // アップロードされた画像を保存する
            // 画像のファイルの記述情報を$imgへ代入
            $img = file_get_contents($upload_image);
            // Adテーブルのidカラムの最大値を取得
            $maxId = Ad::max('id');
            // idの+1をファイル名にする
            $ads_num = $maxId + 1;
            $path = "ads_top-$ads_num";

            // Storage/public内に画像ファイルを保存
            Storage::disk('public')->put($path, $img);

            if ($path) {
                \DB::beginTransaction();
                try {
                    $ad->fill([
                        'file_name' => $upload_image,
                        'file_path' => Storage::url($path),
                        'link' => $inputs['ad-link1'],
                        'location' => $inputs['location'],
                    ]);
                    $ad->save();
                    \DB::commit();
                } catch(\Throwable $e) {
                    \DB::rollback();
                    return redirect()->route('admin.home');
                }
            }
        } 

        return redirect()->route('admin.home');
    }

    /**
     * 広告（下）のアップロード処理
     * @param App\Http\Requests\AdsBottomCreateRequest $request
     */
    public function upload_bottom(AdsBottomCreateRequest $request)
    {
        // 送られてきたデータを取得
        $inputs = $request->all();
        // 送られてきた画像情報を取得(変数へ代入)
        $upload_image = $request->input('image2');
        // Adインスタンスの作成
        $ad = new Ad();
       
        // 画像が存在すれば条件分岐
        if ($upload_image) {
            // アップロードされた画像を保存する
            // 画像のファイルの記述情報を$imgへ代入
            $img = file_get_contents($upload_image);
            // Adテーブルのidカラムの最大値を取得
            $maxId = Ad::max('id');
            // idの+1をファイル名にする
            $ads_num = $maxId + 1;
            $path = "ads_bottom-$ads_num";

            // Storage/public内に画像ファイルを保存
            Storage::disk('public')->put($path, $img);

            if ($path) {
                \DB::beginTransaction();
                try {
                    $ad->fill([
                        'file_name' => $upload_image,
                        'file_path' => Storage::url($path),
                        'link' => $inputs['ad-link2'],
                        'location' => $inputs['location'],
                    ]);
                    $ad->save();
                    \DB::commit();
                } catch(\Throwable $e) {
                    \DB::rollback();
                    return redirect()->route('admin.home');
                }
            }
        } 

        return redirect()->route('admin.home');
    }
}
