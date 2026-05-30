<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::with('verificationCodes')->paginate(20);

        return view('admin.users.index', compact('users'));
    }
}
