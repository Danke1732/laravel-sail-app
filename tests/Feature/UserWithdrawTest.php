<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserWithdrawTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザーの退会テスト
     * @return void
     */
    public function testUserDelete()
    {
        // 商品の作成
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post("/user/withdraw/$user->id");
        $response->assertStatus(302)->assertRedirect(route('calculate'));
    }

    /**
     * ユーザーの退会(失敗)テスト
     * @return void
     */
    public function testUserDeleteFail()
    {
        // 商品の作成
        $user = User::factory()->create();
        // ユーザー2作成
        $user2 = User::factory()->create();
        
        // ログイン未の失敗
        $response = $this->post("/user/withdraw/$user->id");
        $response->assertStatus(302)->assertRedirect(route('login'));

        // 他ユーザーからのアクセス
        $response = $this->actingAs($user2)->post("/user/withdraw/$user->id");
        $response->assertStatus(302)->assertRedirect(route('calculate'));
    }
}
