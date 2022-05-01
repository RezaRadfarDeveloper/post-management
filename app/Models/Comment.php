<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Models\BlogPost;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id'];

    public function commentable() {

        return $this->morphTo();
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    public function scopeLatest(Builder $query) {
        return $query->orderBy('created_at','desc');
    }
}
