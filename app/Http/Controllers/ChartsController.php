<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Chart;
use App\Models\Option;
use App\Models\ChartImage;
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

                        // dd($path);

                        //画像の保存に成功したらDBに記録する
                        if($path){
                            $chart_image1->fill([
                                "image_name" => $upload_image->getClientOriginalName(),
                                "image_path" => $path,
                                "chart_id" => $chartId,
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
}
