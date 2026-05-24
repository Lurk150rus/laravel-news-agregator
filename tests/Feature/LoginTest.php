<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_page():void
    {
        $response = $this->get('/login');
        $response->assertViewIs('auth.login');
        $response->assertStatus(200);
    }

    public function test_correct_login(): void
    {
        \App\Models\User::factory()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        $response = $this->postJson('/login', [
            'login' => 'testuser',
            'password' => 'password123',
        ]);
        $response->assertStatus(200);
    }

    public function test_incorrect_login(): void
    {
        \App\Models\User::factory()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        $response = $this->postJson('/login', [
            'login' => 'testuser',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(422);
    }

    public function test_unverified_user_login(): void
    {
        \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        $response = $this->postJson('/login', [
            'login' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertStatus(422);
    }
}
