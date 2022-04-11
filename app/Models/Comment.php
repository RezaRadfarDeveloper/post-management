<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function blogPost() {

        return $this->belongsTo('App\Models\BlogPost');
    }

    public function scopeLatest(Builder $query) {
        return $query->orderBy('created_at','desc');
    }
}
