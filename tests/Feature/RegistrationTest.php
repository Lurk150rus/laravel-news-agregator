<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Проверяет, что при регистрации пользователя создается запись в таблице verification_codes, связанная с этим пользователем.
     */
    public function test_user_registration_creates_verification_code(): void
    {
        $response = $this->post('/register', [
            'login' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertStatus(201);

        $user = \App\Models\User::where('login', 'testuser')->first();
        $this->assertNotNull($user);

        $this->assertDatabaseHas('verification_codes', ['user_id' => $user->id]);
    }
}
