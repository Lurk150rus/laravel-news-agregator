<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_not_auth(): void
    {
        $response = $this->get('/news');

        $response->assertStatus(403);
    }

    public function test_auth_verified(): void
    {
        $user = \App\Models\User::factory()->create();
        News::factory()->count(25)->create();

        $response = $this->actingAs($user)->get('/news');
        $response->viewData('news');
        $response->assertStatus(200);
        $response->assertViewIs('news.index');
    }

    public function test_auth_not_verified(): void
    {
        $user = \App\Models\User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/news');

        $response->assertStatus(403);
    }
}
