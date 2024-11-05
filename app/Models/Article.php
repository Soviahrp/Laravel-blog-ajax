<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'published',
        'published_at',
        'is_confirm',
        'image',
        'keywords',
        'views'
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->user_id = Auth::user()->id;
        });
    }

    public static function filter($search)
    {
        return Article::where('title', 'like', "%{$search}%")
            ->orWhere('slug', 'like', "%{$search}%");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // one to one
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // many to many
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

}

