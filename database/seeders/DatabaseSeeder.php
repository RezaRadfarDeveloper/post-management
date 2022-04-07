<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $admin =  User::factory()->defaultAdmin()->create();
      $non_admins =   User::factory()->count(3)->create();
     $users = $non_admins->concat([$admin]);

    $posts = BlogPost::factory()->count(20)->make()->each(function($post) use ($users) {
         $post->user_id = $users->random()->id;
         $post->save();
     });

    $comments = Comment::factory()->count(40)->make()->each(function ($comment) use ($posts) {
         $comment->blog_post_id = $posts->random()->id;
         $comment->save();
     });


    }
}
