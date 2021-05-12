<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;

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
        $random_key = rand(0, (count($ads_top_lists) - 1));
        $ad_top = $ads_top_lists[$random_key];
        // ランダムな下部広告をViewへ渡す
        $ads_bottom_lists = Ad::where('location', 1)->get();
        $random_key = rand(0, (count($ads_bottom_lists) - 1));
        $ad_bottom = $ads_bottom_lists[$random_key];

        return view("home", ["ad_top" => $ad_top, "ad_bottom" => $ad_bottom]);
    }
}
