<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_admin_user_can_access_admin_panel(): void
    {
        $admin = \App\Models\User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertViewIs('admin.dashboard');
        $response->assertStatus(200);
    }

    public function test_not_admin_user_cant_access_admin_panel(): void
    {
        $user = \App\Models\User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(403);
    }

    public function test_guest_cant_access_admin_panel(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_admin_user_can_see_users(): void
    {
        $admin = \App\Models\User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertViewIs('admin.users.index');
        $response->assertStatus(200);
    }

    public function test_admin_user_can_see_verifications(): void
    {
        $admin = \App\Models\User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/verifications');

        $response->assertViewIs('admin.verifications.index');
        $response->assertStatus(200);
    }

     public function test_admin_user_can_see_news(): void
    {
        $admin = \App\Models\User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/news');

        $response->assertViewIs('admin.news.index');
        $response->assertStatus(200);
    }

}
