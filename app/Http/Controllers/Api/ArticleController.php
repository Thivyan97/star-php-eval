<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        // Eager load the category to avoid N+1 queries (1 query for articles + 1 for categories)
        $articles = Article::with('category')
            ->published()
            ->latest('published_at')
            ->get();

        return ArticleResource::collection($articles);
    }
}