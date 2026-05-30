<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $usersCount = \App\Models\User::count();
        $newsCount = \App\Models\News::count();
        $verificationsCount = \App\Models\VerificationCode::count();

        return view('admin.dashboard', compact('usersCount', 'newsCount', 'verificationsCount'));
    }
}
