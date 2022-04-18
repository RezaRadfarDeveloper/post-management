<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    public function blogPost() {

        return $this->belongsTo('App\Models\BlogPost');
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeLatest(Builder $query) {
        return $query->orderBy('created_at','desc');
    }

    public static function booted() {

        static::creating(function($comment) {
            Cache::forget("blog-post-{$comment->blog_post_id}");
            Cache::forget("mostCommented");
        });
    }
}
