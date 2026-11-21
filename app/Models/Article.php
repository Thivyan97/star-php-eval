<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'body',
        'published_at',
        'permalink',
        'category_id',
        'author',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'published');
    }

    protected function readingTime(): Attribute
    {
        return Attribute::get(fn () => max(1, (int) ceil(str_word_count($this->body) / 200)));
    }

    public function getRouteKeyName(): string
    {
        return 'permalink';
    }
}