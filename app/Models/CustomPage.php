<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;

    protected $table = 'custom_pages';

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'show_in_menu',
        'order_index',
        'is_published',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'show_in_menu' => 'boolean',
        'is_published' => 'boolean',
        'order_index' => 'integer',
    ];

    /**
     * Scope a query to only include published pages.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope a query to only include pages designated for the navigation menu.
     */
    public function scopeInMenu(Builder $query): Builder
    {
        return $query->where('show_in_menu', true)->orderBy('order_index', 'asc');
    }
}
