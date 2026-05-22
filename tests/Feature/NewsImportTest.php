<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsImportTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_news_import(): void
    {
        $this->artisan('news:import')
            ->assertExitCode(0);
    }
}
