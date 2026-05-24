<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
    public function login(array $data): array
    {
        $user = User::firstWhere('login', $data['login']);

        if (!$user || Hash::check($data['password'], $user->password) === false) {
            throw ValidationException::withMessages([
                'login' => 'Invalid credentials',
            ]);
        }

        auth()->login($user);

        return [
            'user' => [
                'id' => $user->id,
                'login' => $user->login,
            ],
        ];
    }
}
