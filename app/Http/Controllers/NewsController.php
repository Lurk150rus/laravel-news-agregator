<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\News\NewsQueryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function search(Request $request): JsonResponse
    {
        $query = $request->get('search');

        if (! $query) {
            return response()->json([]);
        }

        $news = \App\Models\News::query()
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title']);
        return response()->json($news);
    }
}
