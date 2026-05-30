<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class VerificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    /**
     * Максимальное количество попыток для авторизации
     * @var int
     */
    const MAX_ATTEMPTS = 5;

    public function test_verification_page(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);
        Auth::login($user);
        $response = $this->get('/verify');
        $response->assertViewIs('auth.verify');
        $response->assertStatus(200);
    }

    public function test_verification(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        Auth::login($user);

        $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);

        $response = $this->post('/verify', [
            'code' => '123456',
        ]);

        $response->assertStatus(302);
        $user->refresh();
        $this->assertTrue((bool) $user->is_verified);
    }

    public function test_verification_with_invalid_code(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        Auth::login($user);

        $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);

        $response = $this->postJson('/verify', [
            'code' => '654321',
        ]);

        $response->assertStatus(422);
    }

    public function test_verification_with_expired_code(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        Auth::login($user);

        $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->subMinutes(10),
            'sent_at' => now()->subMinutes(20),
        ]);

        $response = $this->postJson('/verify', [
            'code' => '123456',
        ]);

        $response->assertStatus(422);
    }

    public function test_verification_with_too_many_attempts(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        Auth::login($user);

        $verification = $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);


        for($i = 0; $i < self::MAX_ATTEMPTS; $i++) {
            $response = $this->postJson('/verify', [
                'code' => '654321',
            ]);

            $response->assertStatus(422);
        }

        $response = $this->postJson('/verify', [
            'login' => 'testuser',
            'code' => '123456',
        ]);

        $response->assertStatus(422);
    }
}
