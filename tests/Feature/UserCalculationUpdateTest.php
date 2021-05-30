<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Chart;
use App\Models\Option;
use App\Models\ChartImage;
use DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserCalculationUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー計算結果登録のテスト
     * @return void
     */
    public function testUserUpdate()
    {
        // ユーザーの作成
        $user = User::factory()->create();
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
        // フェイクディスクの作成
        // storage/framework/testing/disks/testImagesに保存用ディスクが作成される
        // (指定しなければtestImagesではなく、localフォルダが保存用に使用される)
        Storage::fake('testImages');
        // Storage::persistentFake('testImages'); テスト後も画像ファイルが残る

        // UploadedFileクラスを用意
        $file = UploadedFile::fake()->image('test', 328, 1024)->size(1000);
        // 作成した画像を移動
        $file->move('storage/framework/testing/disks/testImages');

        // 広告アップロード処理テスト
        $response = $this->actingAs($user)->withSession(['admin_auth' => true])->post(("/calc_update/$chart->id"), [

            "property_price" => $chart_make['property_price'],
            "purchase_fee" => $chart_make['purchase_fee'],
            "borrowing_amount" => $chart_make['borrowing_amount'],
            "annual_interest" => $chart_make['annual_interest'],
            "borrowing_period" => $chart_make['borrowing_period'],
            "monthly_rent_income" => $chart_make['monthly_rent_income'],
            "expense" => $chart_make['expense'],
            "vacancy" => $chart_make['vacancy'],
            "tax" => $chart_make['tax'],
            "ownership_period" => $chart_make['ownership_period'],
            "sale_price" => $chart_make['sale_price'],
            "sale_commission" => $chart_make['sale_commission'],
            "property_name" => $chart_option_make['property_name'],
            "age" => $chart_option_make['age'],
            "note" => $chart_option_make['note'],
            "image_location1" => 1,
            "image_location2" => 2,
            "image_location3" => 3,
            "user_id" => $user->id,
            "image1" => $file,
            "image_location1" => 1,
            "change_flag1" => 1,
            "image_location2" => 2,
            "change_flag2" => 0,
            "image_location3" => 3,
            "change_flag3" => 0,
            "id" => $chart_make->id,
        ]);

        $response->assertStatus(302)->assertRedirect(route('calculate'));

        // storage/framework/testing/disks/testImages内に該当ファイルが存在するか
        Storage::disk('testImages')->assertExists($file->getFileName());
    }

}
