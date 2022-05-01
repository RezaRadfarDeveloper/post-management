<?php

namespace App\Listeners;

use App\Events\CommentPostedEvent;
use App\Mail\CommentPosted;
use App\Jobs\NotifyUsersCommentedOnPostWatched;
use Illuminate\Support\Facades\Mail;

class NotifyUsersAboutComment
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPostedEvent $event)
    {
        Mail::to($event->comment->commentable->user)->send(
            new CommentPosted($event->comment)
        );

        NotifyUsersCommentedOnPostWatched::dispatch($event->comment);
    }
}
