<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsCount = Tag::all()->count();
        $minTags = $this->command->ask('Minimum number of tags?', 0);
        $maxTags = min((int)$this->command->ask("Maximum number of tags?", $tagsCount), $tagsCount);

        BlogPost::all()->each(function ($post) use ($maxTags,$minTags) {
            $take = random_int($minTags, $maxTags);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');

            $post->tags()->sync($tags);
        });
    }
}
