<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResendVerificationCodeTest extends TestCase
{
    use RefreshDatabase;

    const COOLDOWN_SECONDS = 60;
    /**
     * A basic feature test example.
     */
    public function test_resend_need_more_time_to_cooldown(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now(),
        ]);

        $response = $this->postJson('/resend-code', [
            'login' => 'testuser',
        ]);

        $response->assertStatus(422);
    }

    public function test_resend_code(): void
    {
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->addMinutes(10),
            'sent_at' => now()->subSeconds(self::COOLDOWN_SECONDS + 1),
        ]);

        $response = $this->postJson('/resend-code', [
            'login' => 'testuser',
        ]);

        $response->assertStatus(200);
    }
}
