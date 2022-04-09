<?php

namespace Database\Seeders;

use App\Http\Controllers\PostsController;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();
        if($posts->count() <= 0) {
            $this->command->info('there is no post added');
            return;
        }
        $commentCount = (int)$this->command->ask('How many commenta do you want to create?',150);

        Comment::factory()->count($commentCount)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
