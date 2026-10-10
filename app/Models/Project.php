<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'summary',
        'description',
        'cover_image',
        'demo_url',
        'github_url',
        'architecture_notes',
        'features',
        'metrics',
        'is_featured',
        'order_index',
        'status',
    ];

    protected $casts = [
        'features' => 'array',
        'metrics' => 'array',
        'is_featured' => 'boolean',
        'order_index' => 'integer',
    ];

    public function techStacks(): BelongsToMany
    {
        return $this->belongsToMany(TechStack::class, 'project_tech_stack');
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeFilterByTech(Builder $query, string $techSlug): Builder
    {
        return $query->whereHas('techStacks', function ($q) use ($techSlug) {
            $q->where('slug', $techSlug);
        });
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('title', 'ILIKE', "%{$term}%")
                ->orWhere('tagline', 'ILIKE', "%{$term}%")
                ->orWhere('summary', 'ILIKE', "%{$term}%")
                ->orWhere('description', 'ILIKE', "%{$term}%");
        });
    }
}
