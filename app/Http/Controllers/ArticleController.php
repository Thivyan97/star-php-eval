<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        // Eager load category
        $articles = Article::with('category')
            ->published()
            ->latest('published_at')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article): View
    {
        abort_unless($article->status === 'published', 404);

        $article->load('category');

        $related = Article::with('category')
            ->published()
            ->where('category_id', $article->category_id)
            ->whereKeyNot($article->getKey())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'related'));
    }
}