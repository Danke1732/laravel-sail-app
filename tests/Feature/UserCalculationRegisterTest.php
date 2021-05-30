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

class UserCalculationRegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザー計算結果登録のテスト
     * @return void
     */
    public function testUserUpload()
    {
        // ユーザーの作成
        $user = User::factory()->create();
        // 広告データの作成
        $chart = Chart::factory()->make(array($user));
        $chart_image = ChartImage::factory()->make(array($chart));
        $chart_option = Option::factory()->make(array($chart));
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
        $response = $this->withSession(['admin_auth' => true])->post(route('ads.upload_top'), [

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
            "image1" => $file,
        ]);

        $response->assertStatus(302)->assertRedirect(route('calculate'));

        // storage/framework/testing/disks/testImages内に該当ファイルが存在するか
        Storage::disk('testImages')->assertExists($file->getFileName());
    }

}
