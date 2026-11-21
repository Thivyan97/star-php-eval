<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    protected function color(): Attribute
    {
        return Attribute::get(fn () => match ($this->name) {
            'Politics' => 'danger',
            'Business' => 'success',
            'Sports' => 'primary',
            'Technology' => 'info',
            'Entertainment' => 'warning',
            'Lifestyle' => 'secondary',
            default => 'dark',
        });
    }
}