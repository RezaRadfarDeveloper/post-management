<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentsAddedOnWatchedPost extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $comment;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, User $user)
    {
        $this->user = $user;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Users Commented on the same post as {$this->comment->commentable->title}";
        return $this->subject($subject)
        ->view('emails.posts.comments-on-watched-post');
    }
}
