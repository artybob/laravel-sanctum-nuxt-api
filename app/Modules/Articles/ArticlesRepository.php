<?php

namespace App\Modules\Articles;

use Illuminate\Database\Eloquent\Collection;

interface ArticlesRepository
{
    public function search(string $query = ''): Collection;
}
