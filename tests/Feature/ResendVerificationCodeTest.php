<?php

namespace Tests\Feature;

use App\Jobs\SendVerificationCodeJob;
use App\Services\Messenger\Contract\MessengerInterface;
use App\Services\Messenger\FakeMessenger;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ResendVerificationCodeTest extends TestCase
{
    use RefreshDatabase;

    const COOLDOWN_SECONDS = 60;
    /**
     * A basic feature test example.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(MessengerInterface::class, FakeMessenger::class);
    }
    public function test_resend_need_more_time_to_cooldown(): void
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

        $response = $this->postJson('/resend-code', [
        ]);

        $response->assertStatus(422);
    }

    public function test_resend_code(): void
    {
        Queue::fake();
        $user = \App\Models\User::factory()->unverified()->create([
            'login' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]);

        $user->verificationCodes()->create([
            'code' => '123456',
            'expires_at' => now()->addMinutes(10),
        ]);

        $this->travel(self::COOLDOWN_SECONDS + 1)->seconds();

        Auth::login($user);

        $response = $this->postJson('/resend-code');
        $code = \App\Models\VerificationCode::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        Queue::assertPushed(SendVerificationCodeJob::class, function ($job) use ($user, $code) {
            return $job->userId === $user->id && $job->code === $code->code;
        });

        $response->assertStatus(302);
    }
}
