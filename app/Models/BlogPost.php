<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;


class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;
   protected $fillable = ['title','content','user_id'];

   public function comments() {
       return $this->morphMany('App\Models\Comment','commentable')->latest();
   }

   public function user() {
       return $this->belongsTo(User::class);
   }
   public function image() {
       return $this->morphOne(Image::class,'imageable');
   }

   public function scopeLatest(Builder $query) {
       return $query->orderBy('created_at','desc');
   }

   public function scopeMostCommented($query) {
       return $query->withCount('comments')->orderBy('comments_count','desc');
   }
   public function tags() {
       return $this->belongsToMany(Tag::class)->withTimestamps();
   }

   public function scopeLatestWithRelations($query) {
       return $query->latest()->withCount('comments')->with('user','tags');
   }

   public static function booted() {

       static::updating(function($post) {
           Cache::forget("blog-post-{$post->id}");
       });
   }
 }
