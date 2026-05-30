<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    public function index()
    {
        $codes = \App\Models\VerificationCode::with('user')->paginate(20);

        return view('admin.verifications.index', compact('codes'));
    }
}
