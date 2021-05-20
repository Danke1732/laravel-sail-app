<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdsTopCreateRequest;
use App\Http\Requests\AdsBottomCreateRequest;
use App\Http\Requests\AdsUpdateRequest;
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
            return redirect()->route("admin.ads_list");
        }

        // ログイン失敗
        return back()->withErrors([
            'danger' => 'ログイン失敗 : ID/PWを確認してください。',
        ]);
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
            // file_pathに作成日時を付与して一意性を保つ
            $dateTime = date("Y-m-d_H-i-s");
            $path = "ads_top-$dateTime";

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
                    return redirect()->route('admin.ads_new');
                }
            }
        } 

        return redirect()->route('admin.ads_list');
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
            // file_pathに作成日時を付与して一意性を保つ
            $dateTime = date("Y-m-d_H-i-s");
            $path = "ads_bottom-$dateTime";

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
                    return redirect()->route('admin.ads_new');
                }
            }
        } 

        return redirect()->route('admin.ads_list');
    }

    /**
     * 広告編集ページ表示
     * @param $id
     * @return View
     */
    public function ads_edit($id)
    {
        $ad = Ad::find($id);
        return view("admin.ads_edit", ["ad" => $ad]);
    }

    /**
     * 広告の更新処理
     * @param App\Http\Requests\AdsUpdateRequest $request
     */
    public function update(AdsUpdateRequest $request)
    {
        // 送られてきたデータを取得
        $inputs = $request->all();
        // レコードデータを取得
        $ad = Ad::findOrFail($inputs['id']);
        // 送られてきた画像情報を取得(変数へ代入)
        $upload_image = $request->input('image');

        // 送られてきたデータを元に更新処理
        \DB::beginTransaction();
        try {
            // 画像についての更新を行うかチェック
            if (isset($inputs['image']) === true) {
                // 元の画像を削除(substr "/storage/" の文字列を取り除く)
                Storage::disk('public')->delete(substr($ad->file_path, 9));
                // アップロードされた画像を保存する
                // 画像のファイルの記述情報を$imgへ代入
                $img = file_get_contents($upload_image);
                // file_pathに作成日時を付与して一意性を保つ
                $dateTime = date("Y-m-d_H-i-s");
                // 上下どちらの広告かの条件分岐
                if ($inputs['location'] == 0) {
                    $path = "ads_top-$dateTime";
                } else {
                    $path = "ads_bottom-$dateTime";
                }
                // Storage/public内に画像ファイルを保存
                Storage::disk('public')->put($path, $img);
                // Storage内のファイルパスを取得
                $new_path = Storage::url($path);
                // 画像情報更新
                $ad->fill([
                    'file_name' => $upload_image,
                    'file_path' => $new_path,
                ]);
            }
            // 画像以外の更新
            $ad->fill([
                'link' => $inputs['ad-link'],
                'location' => $inputs['location'],
            ]);
            // データの保存
            $ad->save();
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            return redirect()->route('admin.ads_edit');
        }

        return redirect()->route('admin.ads_list');
    }

    /**
     * 広告の削除処理
     * @param  int $id
     * @return view
     */
    function exeDelete($id)
    {
        $ad = Ad::find($id);

        if (is_null($ad)) {
            return redirect()->route('admin.ads_list');
        }

        try {
            if (isset($ad->file_path)) {
                // 元の画像を削除(substr "/storage/" の文字列を取り除く)
                Storage::disk('public')->delete(substr($ad->file_path, 9));
            }
            Ad::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }

        return redirect()->route('admin.ads_list');
    }
}
