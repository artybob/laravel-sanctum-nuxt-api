<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition()
    {
        $tags = collect(['php', 'ruby', 'java', 'javascript', 'bash'])
            ->random(2)
            ->values()
            ->all();

        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->text(),
            'tags' => $tags,
        ];
    }
}
