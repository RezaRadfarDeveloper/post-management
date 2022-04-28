<?php

namespace App\Jobs;

use App\Mail\CommentPosted;
use App\Mail\CommentsAddedOnWatchedPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyUsersCommentedOnPostWatched implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::thatHasCommentedOnTheSamePost($this->comment->commentable)
            ->get()->filter(function($user) {
                return $user->id !== $this->comment->user_id;
            })->map(function($user) {
                Mail::to($user)->send(
                   new CommentsAddedOnWatchedPost($this->comment, $user)
                );
            });
    }
}
