<?php

namespace App\Modules\Articles;

use App\Models\Article;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticsearchRepository implements ArticlesRepository
{
    /** @var Client */
    private $elasticsearch;
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }
    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }
    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Article;
        return $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            "size" => 10000,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'body', 'tags'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
    }
    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Article::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }
}
