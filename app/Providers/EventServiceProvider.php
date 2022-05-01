<?php

namespace App\Providers;

use App\Events\CommentPostedEvent;
use App\Events\NewPostPosted;
use App\Listeners\NotifyAdminNewPostAdded;
use App\Listeners\NotifyUsersAboutComment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommentPostedEvent::class => [
            NotifyUsersAboutComment::class
        ]
        ,NewPostPosted::class=> [
            NotifyAdminNewPostAdded::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
