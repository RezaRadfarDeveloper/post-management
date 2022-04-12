<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;
   protected $fillable = ['title','content','user_id'];

   public function comments() {
       return $this->hasMany('App\Models\Comment')->latest();
   }

   public function user() {
       return $this->belongsTo(User::class);
   }

   public function scopeLatest(Builder $query) {
       return $query->orderBy('created_at','desc');
   }

   public function scopeMostCommented($query) {
       return $query->withCount('comments')->orderBy('comments_count','desc');
   }
 }
