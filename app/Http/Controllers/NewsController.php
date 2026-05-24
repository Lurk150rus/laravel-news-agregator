<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Services\News\NewsQueryService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(NewsRequest $request, NewsQueryService $newsQueryService)
    {
        $news = $newsQueryService->paginate($request->validated());

        return view('news.index', [
            'news' => $news,
        ]);
    }
}
