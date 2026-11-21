<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            'Politics', 'Business', 'Sports',
            'Technology', 'Entertainment', 'Lifestyle',
        ])->map(fn (string $name) => Category::create(['name' => $name]));

        // 20 published articles spread across the categories
        Article::factory(20)->recycle($categories)->create();

        // A few drafts, which the public list will hide
        Article::factory(3)->draft()->recycle($categories)->create();
    }
}