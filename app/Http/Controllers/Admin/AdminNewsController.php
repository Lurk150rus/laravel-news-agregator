<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = \App\Models\News::paginate(20);

        return view('admin.news.index', compact('news'));
    }
}
