<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\News\NewsQueryService;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(NewsRequest $request, NewsQueryService $newsQueryService): View
    {
        $news = $newsQueryService->paginate($request->validated());

        return view('news.index', [
            'news' => $news,
        ]);
    }

    public function show(News $news): View
    {
        return view('news.show', [
            'news' => $news,
        ]);
    }
}
