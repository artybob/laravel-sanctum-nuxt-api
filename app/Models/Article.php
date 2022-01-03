<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, Searchable;

    protected $casts = [
        'tags' => 'json',
        'created_at' => 'date:d F Y',
    ];

}
