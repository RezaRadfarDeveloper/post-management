<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::resource('posts', 'App\Policies\BlogPostPolicy');
//        Gate::define('update-post', function ($user, $post) {
//            return $user->id === $post->user->id;
//        });
//        Gate::define('delete-post', function ($user, $post) {
//            return $user->id === $post->user->id;
//        });
//
        Gate::before(function($user,$ability) {
            if($user->is_admin  && in_array($ability, ['update','delete']))
                return true;
        });
    }
}
