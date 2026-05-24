<?php

declare(strict_types=1);

namespace App\Services\News;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

final class NewsQueryService
{
    public function paginate(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = News::query();

        if (!empty($filters['search'])) {

            $search = $filters['search'];

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['source'])) {
            $query->where('source', $filters['source']);
        }

        return $query->orderBy('received_at', 'desc')->paginate($perPage);
    }
}
