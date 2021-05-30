<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Chart;
use App\Models\Option;
use App\Models\ChartImage;

class UserPageTransitionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 管理者ユーザーページ遷移テスト
     * @return void
     */
    public function testUserPage()
    {
        // ユーザーを作成
        $user = User::factory()->create();
        // 計算記録の作成
        // 計算データの作成
        $chart = Chart::factory()->create([
            'user_id' => $user->id,
        ]);
        $chart_image = ChartImage::factory()->create([
            'chart_id' => $chart->id,
        ]);
        $chart_option = Option::factory()->create([
            'chart_id' => $chart->id,
        ]);

        // 計算データの作成
        $chart_make = Chart::factory()->make(array($user));
        $chart_image_make = ChartImage::factory()->make(array($chart_make));
        $chart_option_make = Option::factory()->make(array($chart_make));

        // --- 管理者ユーザーページ遷移ログイン未テスト ---

        // ホーム画面への遷移テスト(ログイン未)
        $response = $this->get(route('calculate'));
        $response->assertStatus(200)->assertViewIs('home');

        // PDF出力画面への遷移テスト(ログイン未)
        $response = $this->post(route('createPdf'), [

            "property_price" => $chart['property_price'],
            "purchase_fee" => $chart['purchase_fee'],
            "borrowing_amount" => $chart['borrowing_amount'],
            "annual_interest" => $chart['annual_interest'],
            "borrowing_period" => $chart['borrowing_period'],
            "monthly_rent_income" => $chart['monthly_rent_income'],
            "expense" => $chart['expense'],
            "vacancy" => $chart['vacancy'],
            "tax" => $chart['tax'],
            "ownership_period" => $chart['ownership_period'],
            "sale_price" => $chart['sale_price'],
            "sale_commission" => $chart['sale_commission'],
            "property_name" => $chart_option['property_name'],
            "age" => $chart_option['age'],
            "note" => $chart_option['note'],
            "image_location1" => 1,
            "image_location2" => 2,
            "image_location3" => 3,
            "user_id" => $user->id,

        ]);
        $response->assertStatus(200);

        // ユーザー詳細画面への遷移テスト(ログイン未)
        $response = $this->get("/user/$user->id");
        $response->assertStatus(302)->assertRedirect(route('login'));

        // 計算シミュレーション詳細・編集画面への遷移テスト(ログイン未)
        $response = $this->get("/chart/$chart->id");
        $response->assertStatus(302)->assertRedirect(route('login'));

        // --- 管理者ユーザーページ遷移ログイン済みテスト ---

        // ホーム画面への遷移テスト(ログイン済み)
        $response = $this->get(route('calculate'));
        $response->assertStatus(200)->assertViewIs('home');

        // ユーザー詳細画面への遷移テスト(ログイン済み)
        $response = $this->actingAs($user)->get("/user/$user->id");
        $response->assertStatus(200)->assertViewIs('user_detail');

        // 計算シミュレーション詳細・編集画面への遷移テスト(ログイン済み)
        $response = $this->actingAs($user)->get("/chart/$chart->id");
        $response->assertStatus(200)->assertViewIs('chart_edit');
    }
}
