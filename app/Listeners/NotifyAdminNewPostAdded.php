<?php

namespace App\Listeners;

use App\Events\NewPostPosted;
use App\Mail\PostAdded;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotifyAdminNewPostAdded
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NewPostPosted $event)
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $when = now()->addSecond(20);
        User::thatIsAdmin()->get()->map(function ($user) use ($when){
            Mail::to($user)->later($when ,
                new PostAdded()
            );
        });
    }
}
