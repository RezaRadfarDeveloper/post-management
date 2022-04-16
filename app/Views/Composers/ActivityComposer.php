<?php
namespace App\Views\Composers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;


class ActivityComposer {

    public function compose(View $view) {

        $mostCommented = Cache::remember('mostCommented', now()->addSecond(60), function () {
            return BlogPost::mostCommented()->take(5)->get();
        });

        $mostActive = Cache::remember('mostActive', now()->addSecond(60), function () {
            return  User::withMostPosts()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::remember('mostActiveLastMonth', now()->addSecond(60), function () {
            return  User::withMostPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActive', $mostActive);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);
    }
}
