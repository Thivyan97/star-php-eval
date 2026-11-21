<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = sprintf(
            '%s %s %s',
            fake()->randomElement([
                'Government', 'Local council', 'Tech giant', 'National team',
                'Central bank', 'University researchers', 'Health ministry',
                'City authorities', 'Airline', 'Startup',
            ]),
            fake()->randomElement([
                'announces new', 'unveils plan for', 'faces criticism over',
                'secures deal on', 'launches review of', 'reveals results of',
                'postpones decision on', 'welcomes',
            ]),
            fake()->randomElement([
                'public transport upgrades', 'digital payment rules',
                'climate action targets', 'youth sports programme',
                'housing affordability measures', 'cybersecurity standards',
                'energy price review', 'education reforms',
                'tourism recovery strategy', 'healthcare funding',
            ]),
        );

        return [
            'title' => $title,
            'summary' => fake()->sentence(18),
            'body' => fake()->paragraphs(5, true),
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'permalink' => Str::slug($title).'-'.fake()->unique()->numerify('####'),
            'category_id' => Category::factory(),
            'author' => fake()->name(),
            'status' => 'published',
        ];
    }

    public function draft(): static
    {
        return $this->state(fn () => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}