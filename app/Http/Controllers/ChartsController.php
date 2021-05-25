<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Chart;
use App\Models\Option;
use App\Models\ChartImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CalculateRequest;

class ChartsController extends Controller
{
    /**
     * 利回り計算ページ表示
     * @return View
     */
    public function showCalculate()
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

        return view("home", ["ad_top" => $ad_top, "ad_bottom" => $ad_bottom]);
    }

    /**
     * 計算結果登録
     * @param App\Http\Requests\CalculateRequest $request
     */
    public function exeStore(CalculateRequest $request)
    {
        $inputs = $request->all();
        
        \DB::beginTransaction();
        try {
            // Chartオブジェクトの作成
            $chart = new Chart();
            $chart->fill([
                'property_price' => $inputs['property_price'],
                'purchase_fee' => $inputs['purchase_fee'],
                'borrowing_amount' => $inputs['borrowing_amount'],
                'annual_interest' => $inputs['annual_interest'],
                'borrowing_period' => $inputs['borrowing_period'],
                'monthly_rent_income' => $inputs['monthly_rent_income'],
                'expense' => $inputs['expense'],
                'vacancy' => $inputs['vacancy'],
                'tax' => $inputs['tax'],
                'ownership_period' => $inputs['ownership_period'],
                'sale_price' => $inputs['sale_price'],
                'sale_commission' => $inputs['sale_commission'],
                'user_id' => $inputs['user_id'],
            ]);
            $chart->save();
            // 保存した計算表データのIDを取得
            $chartId = $chart->id;

            if (isset($inputs['property_name']) || isset($inputs['age']) || isset($inputs['note'])) {
                // Optionオブジェクト作成
                $option = new Option();
                if (isset($inputs['property_name'])) {
                    $option->fill([
                        'property_name' => $inputs['property_name'],
                    ]);
                }
                if (isset($inputs['age'])) {
                    $option->fill([
                        'age' => $inputs['age'],
                    ]);
                }
                if (isset($inputs['note'])) {
                    $option->fill([
                        'note' => $inputs['note'],
                    ]);
                }
                $option->fill([
                    'chart_id' => $chartId,
                ]);
                $option->save();
            }

            if (isset($inputs['image1']) || isset($inputs['image2']) || isset($inputs['image3'])) {

                if (isset($inputs['image1'])) {
                    // Optionオブジェクト作成
                    $chart_image1 = new ChartImage();
                    $upload_image = $request->file('image1');
                    if ($upload_image) {
                        //アップロードされた画像を保存する
                        $path = $upload_image->store('chart_images',"public");

                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image1->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
                                "location" => $inputs['image_location1'],
                            ]);
                            $chart_image1->save();
                        }
                    }
                }

                if (isset($inputs['image2'])) {
                    // Optionオブジェクト作成
                    $chart_image2 = new ChartImage();
                    $upload_image = $request->file('image2');
                    if ($upload_image) {
                        //アップロードされた画像を保存する
			            $path = $upload_image->store('chart_images',"public");
                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image2->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
                                "location" => $inputs['image_location2'],
                            ]);
                            $chart_image2->save();
                        }
                    }
                }

                if (isset($inputs['image3'])) {
                    // Optionオブジェクト作成
                    $chart_image3 = new ChartImage();
                    $upload_image = $request->file('image3');
                    if ($upload_image) {
                        //アップロードされた画像を保存する
			            $path = $upload_image->store('chart_images',"public");
                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image3->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
                                "location" => $inputs['image_location3'],
                            ]);
                            $chart_image3->save();
                        }
                    }
                }
            }
            \DB::commit();
            return redirect()->route('calculate')->with('success', '計算結果の登録が完了しました！');
        } catch (\Throwable $e) {
            \DB::rollback();
            // 登録失敗
            return back()->withErrors([
                'danger' => '登録に失敗しました。',
            ]);
        }
    }

    /**
     * 計算シミュレーション編集ページ表示
     * @return View
     */
    public function chartEdit($id)
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

        $chart = Chart::find($id);
        $auth_user = Auth::user();

        if (isset($chart)) {
            if ($chart->user_id === $auth_user->id) {
                $chart_option = $chart->option;
                if (empty($chart_option)) {
                    $chart_option = null;
                }
                $chart_images = $chart->chart_images;
                foreach ($chart_images as $image) {
                    if ($image['location'] == 1) {
                        // 画像の場所が1の物があれば$image1に代入
                        $image1 = $image;
                    } elseif ($image['location'] == 2) {
                        // 画像の場所が2の物があれば$image2に代入
                        $image2 = $image;
                    } elseif ($image['location'] == 3) {
                        // 画像の場所が3の物があれば$image3に代入
                        $image3 = $image;
                    }
                }

                if (empty($image1)) {
                    $image1 = null;
                }
                if (empty($image2)) {
                    $image2 = null;
                }
                if (empty($image3)) {
                    $image3 = null;
                }

                return view("chart_edit", ["ad_top" => $ad_top, "ad_bottom" => $ad_bottom, "chart" => $chart, "chart_option" => $chart_option, "image1" => $image1, "image2" => $image2, "image3" => $image3]);
            }

            return redirect()->route("calculate")->with('danger', '不正なリクエストが実行されました。');
        }

        return redirect()->route("calculate")->with('danger', '該当の計算シミュレーションが見つかりませんでした。');

    }

    /**
     * 計算結果更新処理
     * @param App\Http\Requests\CalculateRequest $request
     */
    public function exeUpdate(CalculateRequest $request, $id)
    {
        $inputs = $request->all();
        $inputs["id"] = $id;
 
        $chart = Chart::find($id);
        $auth_user = Auth::user();

        if (!isset($chart)) {
            // 登録失敗
            return back()->withErrors(['danger' => '該当の計算シミュレーションが見つかりませんでした。',]);
        }

        if ($chart->user_id != $auth_user->id) {
            return back()->withErrors(['danger' => '不正なリクエストが実行されました。']);
        }
        
        \DB::beginTransaction();
        try {

            $chart->fill([
                'property_price' => $inputs['property_price'],
                'purchase_fee' => $inputs['purchase_fee'],
                'borrowing_amount' => $inputs['borrowing_amount'],
                'annual_interest' => $inputs['annual_interest'],
                'borrowing_period' => $inputs['borrowing_period'],
                'monthly_rent_income' => $inputs['monthly_rent_income'],
                'expense' => $inputs['expense'],
                'vacancy' => $inputs['vacancy'],
                'tax' => $inputs['tax'],
                'ownership_period' => $inputs['ownership_period'],
                'sale_price' => $inputs['sale_price'],
                'sale_commission' => $inputs['sale_commission'],
                'user_id' => $inputs['user_id'],
            ]);
            $chart->save();
            // 保存した計算表データのIDを取得
            $chartId = $chart->id;

            $option = Option::where('chart_id', $chartId)->first();
            if (!empty($option)) {
                if ($inputs['property_name'] != $chart->option['property_name'] || $inputs['age'] != $chart->option['age'] || $inputs['note'] != $chart->option['note']) {

                    // 該当のOptionオブジェクト呼び出し
                    $option = Option::where('chart_id', $chart->id)->first();
    
                    if ($inputs['property_name'] != $chart->option['property_name']) {
                        $option->fill([
                            'property_name' => $inputs['property_name'],
                        ]);
                    }
                    if ($inputs['age'] != $chart->option['age']) {
                        $option->fill([
                            'age' => $inputs['age'],
                        ]);
                    }
                    if ($inputs['note'] != $chart->option['note']) {
                        $option->fill([
                            'note' => $inputs['note'],
                        ]);
                    }
                    $option->save();
                }
            } else {
                
                if (isset($inputs['property_name']) || isset($inputs['age']) || isset($inputs['note'])) {
                    // Optionオブジェクト作成
                    $option = new Option();
                    if (isset($inputs['property_name'])) {
                        $option->fill([
                            'property_name' => $inputs['property_name'],
                        ]);
                    }
                    if (isset($inputs['age'])) {
                        $option->fill([
                            'age' => $inputs['age'],
                        ]);
                    }
                    if (isset($inputs['note'])) {
                        $option->fill([
                            'note' => $inputs['note'],
                        ]);
                    }
                    $option->fill([
                        'chart_id' => $chartId,
                    ]);
                    $option->save();
                }

            }

            if (empty($inputs['image1'])) {
                $images = $chart->chart_images;
                foreach ($images as $image) {
                    if ($image['location'] == 1 && $inputs['change_flag1'] == 0) {
                        // アプリ内の画像を削除
                        Storage::disk('public')->delete("$image->image_path");
                        // レコードの削除
                        ChartImage::destroy($image->id);
                    }
                }
            }

            if (empty($inputs['image2'])) {
                $images = $chart->chart_images;
                foreach ($images as $image) {
                    if ($image['location'] == 2 && $inputs['change_flag2'] == 0) {
                        // アプリ内の画像を削除
                        Storage::disk('public')->delete("$image->image_path");
                        // レコードの削除
                        ChartImage::destroy($image->id);
                    }
                }
            }

            if (empty($inputs['image3'])) {
                $images = $chart->chart_images;
                foreach ($images as $image) {
                    if ($image['location'] == 3 && $inputs['change_flag3'] == 0) {
                        // アプリ内の画像を削除
                        Storage::disk('public')->delete("$image->image_path");
                        // レコードの削除
                        ChartImage::destroy($image->id);
                    }
                }
            }

            if (isset($inputs['image1']) || isset($inputs['image2']) || isset($inputs['image3'])) {

                if (isset($inputs['image1'])) {
                    $images = $chart->chart_images;
                    foreach ($images as $image) {
                        if ($image['location'] == 1) {
                            // アプリ内の画像を削除
                            Storage::disk('public')->delete("$image->image_path");
                            // レコードの削除
                            ChartImage::destroy($image->id);
                        }
                    }

                    // Optionオブジェクト作成
                    $chart_image1 = new ChartImage();
                    $upload_image = $request->file('image1');
                    if ($upload_image) {
                        //アップロードされた画像を保存する
			            $path = $upload_image->store('chart_images',"public");

                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image1->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
                                "location" => $inputs['image_location1'],
                            ]);
                            $chart_image1->save();
                        }
                    }
                }

                if (isset($inputs['image2'])) {
                    $images = $chart->chart_images;
                    foreach ($images as $image) {
                        if ($image['location'] == 2) {
                            // アプリ内の画像を削除
                            Storage::disk('public')->delete("$image->image_path");
                            // レコードの削除
                            ChartImage::destroy($image->id);
                        }
                    }

                    // Optionオブジェクト作成
                    $chart_image2 = new ChartImage();
                    $upload_image = $request->file('image2');
                    if ($upload_image) {
                        //アップロードされた画像を保存する
			            $path = $upload_image->store('chart_images',"public");
                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image2->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
                                "location" => $inputs['image_location2'],
                            ]);
                            $chart_image2->save();
                        }
                    }
                }

                if (isset($inputs['image3'])) {
                    $images = $chart->chart_images;
                    foreach ($images as $image) {
                        if ($image['location'] == 3) {
                            // アプリ内の画像を削除
                            Storage::disk('public')->delete("$image->image_path");
                            // レコードの削除
                            ChartImage::destroy($image->id);
                        }
                    }

                    // Optionオブジェクト作成
                    $chart_image3 = new ChartImage();
                    $upload_image = $request->file('image3');
                    if ($upload_image) {
                        //アップロードされた画像を保存する
			            $path = $upload_image->store('chart_images',"public");
                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image3->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
                                "location" => $inputs['image_location3'],
                            ]);
                            $chart_image3->save();
                        }
                    }
                }
            }

            \DB::commit();
            return redirect()->route("user_detail", $auth_user->id)->with('success', '計算結果の更新が完了しました！');
        } catch (\Throwable $e) {
            \DB::rollback();
            echo $e;
            // 登録失敗
            return back()->withErrors([
                'danger' => '登録に失敗しました。',
            ]);
        }
    }

}
