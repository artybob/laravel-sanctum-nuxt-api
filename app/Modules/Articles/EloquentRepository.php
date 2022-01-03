<?php

namespace App\Modules\Articles;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository
{
    public function search(string $query = ''): Collection
    {
        return Article::query()
            ->where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}
