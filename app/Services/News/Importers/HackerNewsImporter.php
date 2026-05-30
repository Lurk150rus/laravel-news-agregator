<?php

declare(strict_types=1);

namespace App\Services\News\Importers;

use App\Models\News;
use App\Services\News\Contracts\NewsImporterInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class HackerNewsImporter implements NewsImporterInterface
{
    const NEWS_COUNT = 5;

    /**
     * @inheritDoc
     */
    public function import(): int
    {
        $created = 0;

        $response = Http::get(
            'https://hacker-news.firebaseio.com/v0/topstories.json'
        );

        if ($response->failed()) {
            return $created;
        }

        $ids = $response->json();
        $pluckIds = array_slice($ids, 0, self::NEWS_COUNT);

        // TODO: вынос в очередь и обработка в фоне

        foreach ($pluckIds as $id) {

            $itemResponse = Http::get(
                "https://hacker-news.firebaseio.com/v0/item/{$id}.json"
            );

            if ($itemResponse->failed()) {
                continue;
            }

            $itemData = $itemResponse->json();

            if (!isset($itemData['type']) || $itemData['type'] !== 'story') {
                continue;
            }

            $news = News::firstOrCreate([
                'source' => 'hacker_news',
                'external_id' => (string) ($itemData['id'] ?? $id),
            ], [
                'title' => $itemData['title'] ?? 'No title',
                'description' => Str::limit(strip_tags($itemData['text'] ?? ''), 200),
                'content' => $itemData['text'] ?? '',
                'published_at' => isset($itemData['time'])
                    ? now()->createFromTimestamp($itemData['time'])
                    : null,
                'received_at' => now()->format('Y-m-d H:i:s'),
            ]);

            if ($news->wasRecentlyCreated) {
                $created++;
            }
        }


        return $created;
    }
}
