<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Ad;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 管理者ユーザーページ遷移テスト
     * @return void
     */
    public function testPage()
    {

        // 広告を作成
        $ad = Ad::factory()->create();

        // --- 管理者ユーザーページ遷移ログイン未テスト ---

        // 管理者ログイン画面への遷移テスト(ログイン未)
        $response = $this->get(route('admin.showLogin'));
        $response->assertStatus(200)->assertViewIs('admin.admin_login');

        // 広告登録フォーム画面への遷移テスト(ログイン未)
        $response = $this->get(route('admin.ads_new'));
        $response->assertStatus(302)->assertRedirect(route('admin.showLogin'));

        // 広告一覧画面への遷移テスト(ログイン未)
        $response = $this->get(route('admin.ads_list'));
        $response->assertStatus(302)->assertRedirect(route('admin.showLogin'));

        // 広告編集フォーム画面への遷移テスト(ログイン未)
        $response = $this->get('/admin/ads_edit/1');
        $response->assertStatus(302)->assertRedirect(route('admin.showLogin'));

        // --- 管理者ユーザーページ遷移ログイン済みテスト ---

        // 管理者ログインフォーム画面への遷移テスト(ログイン済み)
        $response = $this->withSession(['admin_auth' => true])->get(route('admin.showLogin'));
        $response->assertStatus(302)->assertRedirect(route('admin.ads_list'));

        // 広告登録フォーム画面への遷移テスト(ログイン済み)
        $response = $this->withSession(['admin_auth' => true])->get(route('admin.ads_new'));
        $response->assertStatus(200)->assertViewIs('admin.ads_new');

        // 広告一覧画面への遷移テスト(ログイン済み)
        $response = $this->withSession(['admin_auth' => true])->get(route('admin.ads_list'));
        $response->assertStatus(200)->assertViewIs('admin.ads_list');

        // 広告編集フォーム画面への遷移テスト(ログイン済み)
        $response = $this->withSession(['admin_auth' => true])->get('/admin/ads_edit/1');
        $response->assertStatus(200)->assertViewIs('admin.ads_edit');
    }

    /**
     * 管理者ログインテスト
     * @return void
     */
    public function testAdminLogin()
    {
        // 管理者ユーザーでログイン
        $response = $this->withSession(['admin_auth' => false])->post(route('admin.login'), [
            'admin_id' => config('admin.admin_id'),
            'password' => config('admin.admin_pass'),
        ]);
        $response->assertStatus(302)->assertRedirect(route('admin.ads_list'));
    }

    /**
     * 管理者ログアウトテスト
     * @return void
     */
    public function testAdminLogout()
    {
        // 管理者ユーザーでログアウト
        $response = $this->withSession(['admin_auth' => true])->post(route('admin.logout'));
        $response->assertStatus(302)->assertRedirect(route('admin.showLogin'));
    }

    /**
     * 広告の削除テスト
     * @return void
     */
    public function testFoodDelete()
    {
        // 広告の作成
        $ad = Ad::factory()->create();
        
        $response = $this->withSession(['admin_auth' => true])->post('/admin/ads_delete/1');
        $response->assertStatus(302)->assertRedirect(route('admin.ads_list'));
    }

    /**
     * 広告(上)登録処理のテスト
     * @return void
     */
    public function testAdminUpload()
    {
        // 広告データの作成
        $ad = Ad::factory()->make();
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
        $response = $this->withSession(['admin_auth' => true])->from('/admin/ads_list')->post(route('ads.upload_top'), [
            'file_name' => $ad['file_name'],
            'file_path' => $file,
            'link' => $ad['link'],
            'location' => $ad['location'],
        ]);

        $response->assertStatus(302)->assertRedirect(route('admin.ads_list'));

        // storage/framework/testing/disks/testImages内に該当ファイルが存在するか
        Storage::disk('testImages')->assertExists($file->getFileName());
    }

    /**
     * 広告(下)登録処理のテスト
     * @return void
     */
    public function testAdminUpload2()
    {
        // 広告データの作成
        $ad = Ad::factory()->make();
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
        $response = $this->withSession(['admin_auth' => true])->from('/admin/ads_list')->post(route('ads.upload_bottom'), [
            'file_name' => $ad['file_name'],
            'file_path' => $file,
            'link' => $ad['link'],
            'location' => $ad['location'],
        ]);

        $response->assertStatus(302)->assertRedirect(route('admin.ads_list'));

        // storage/framework/testing/disks/testImages内に該当ファイルが存在するか
        Storage::disk('testImages')->assertExists($file->getFileName());
    }

    /**
     * 広告(下)登録処理のテスト
     * @return void
     */
    public function testAdminUpdate()
    {
        // 広告データの作成
        $ad = Ad::factory()->create();
        $ad_make = Ad::factory()->make();
        // フェイクディスクの作成
        // storage/framework/testing/disks/testImagesに保存用ディスクが作成される
        // (指定しなければtestImagesではなく、localフォルダが保存用に使用される)
        Storage::fake('testImages');
        // Storage::persistentFake('testImages'); テスト後も画像ファイルが残る

        // UploadedFileクラスを用意
        $file = UploadedFile::fake()->image('test', 328, 1024)->size(1000);
        // 作成した画像を移動
        $file->move('storage/framework/testing/disks/testImages');

        // admin/ads_edit/{id}

        // 広告アップロード処理テスト
        $response = $this->withSession(['admin_auth' => true])->from('/admin/ads_list')->post(route('ads.update'), [
            'file_name' => $ad_make['file_name'],
            'file_path' => $file,
            'link' => $ad_make['link'],
            'location' => $ad_make['location'],
        ]);

        $response->assertStatus(302)->assertRedirect(route('admin.ads_list'));

        // storage/framework/testing/disks/testImages内に該当ファイルが存在するか
        Storage::disk('testImages')->assertExists($file->getFileName());
    }

    /**
     * 登録した広告情報がDBに登録されているか確認テスト
     * @return void
     */
    public function testDB()
    {
        $ad_make = Ad::factory()->make();

        // 特定の広告情報を登録
        Ad::factory()->create([
            'file_name' => $ad_make['file_name'],
            'file_path' => $ad_make['file_path'],
            'link' => $ad_make['link'],
            'location' => $ad_make['location'],
        ]);
        // 複数の広告を登録
        Ad::factory()->count(5)->create();
        // 特定ユーザーがDBに存在するか確認
        $this->assertDatabaseHas('ads', [
            'file_name' => $ad_make['file_name'],
            'file_path' => $ad_make['file_path'],
            'link' => $ad_make['link'],
            'location' => $ad_make['location'],
        ]);
    }
}
