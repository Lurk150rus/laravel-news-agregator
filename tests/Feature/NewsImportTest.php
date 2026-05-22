<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NewsImportTest extends TestCase
{
    use RefreshDatabase;
    const NEWS_COUNT_FOR_TEST = 2;
    /**
     * A basic feature test example.
     */
    public function test_news_import(): void
    {
        Http::fake([
            'hacker-news.firebaseio.com/v0/topstories.json' => Http::response([1, 2], 200),

            'hacker-news.firebaseio.com/v0/item/1.json' => Http::response([
                'id' => 1,
                'type' => 'story',
                'title' => 'Test 1',
                'text' => 'Body 1',
                'time' => now()->timestamp,
            ], 200),

            'hacker-news.firebaseio.com/v0/item/2.json' => Http::response([
                'id' => 2,
                'type' => 'story',
                'title' => 'Test 2',
                'text' => 'Body 2',
                'time' => now()->timestamp,
            ], 200),
        ]);

        $this->artisan('news:import')
            ->assertExitCode(0);

        $this->assertDatabaseCount('news', self::NEWS_COUNT_FOR_TEST);
    }

    public function test_repeat_import_does_not_create_duplicates(): void
    {
        Http::fake([
            'hacker-news.firebaseio.com/v0/topstories.json' => Http::response([1, 2], 200),

            'hacker-news.firebaseio.com/v0/item/1.json' => Http::response([
                'id' => 1,
                'type' => 'story',
                'title' => 'Test 1',
                'text' => 'Body 1',
                'time' => now()->timestamp,
            ], 200),

            'hacker-news.firebaseio.com/v0/item/2.json' => Http::response([
                'id' => 2,
                'type' => 'story',
                'title' => 'Test 2',
                'text' => 'Body 2',
                'time' => now()->timestamp,
            ], 200),
        ]);

        $this->artisan('news:import')->assertExitCode(0);

        $this->assertDatabaseCount('news', 2);

        $this->artisan('news:import')->assertExitCode(0);

        $this->assertDatabaseCount('news', 2);
    }
}
