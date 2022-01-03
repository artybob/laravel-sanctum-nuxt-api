<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Modules\Articles\ArticlesRepository;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function getArticles() {
        return Article::all();
    }

    public function search(ArticlesRepository $repository, Request $request) {
        if($request->q) {
            return $repository->search($request->q);
        }

        return $this->getArticles();
    }

}
