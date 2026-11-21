<?php

use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns published articles as json with their category', function () {
    $categories = Category::factory(2)->create();
    Article::factory(3)->recycle($categories)->create();
    Article::factory()->draft()->recycle($categories)->create();

    $this->getJson('/api/articles')
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [['id', 'title', 'summary', 'permalink', 'author', 'published_at', 'category']],
        ]);
});

it('shows the list and detail pages for a published article', function () {
    $article = Article::factory()->create();

    $this->get('/')->assertOk()->assertSee($article->title);
    $this->get(route('articles.show', $article))->assertOk()->assertSee($article->title);
});

it('hides draft articles from the detail page', function () {
    $draft = Article::factory()->draft()->create();

    $this->get(route('articles.show', $draft))->assertNotFound();
});

it('seeds at least 5 categories and 20 published articles', function () {
    $this->seed();

    expect(Category::count())->toBeGreaterThanOrEqual(5)
        ->and(Article::published()->count())->toBeGreaterThanOrEqual(20);
});