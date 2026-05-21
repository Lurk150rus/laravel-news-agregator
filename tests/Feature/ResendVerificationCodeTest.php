<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResendVerificationCodeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_resend(): void
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

        $response->assertStatus(200);
    }
}
