<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class FeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_dashboard_can_be_accessed()
    {
        $user = User::factory()->create();

        // ミドルウェアを無効化してテスト実行
        $this->withoutMiddleware();
        
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

}
