<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Events\CommentPostedEvent;
use App\Models\BlogPost;

class PostCommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only('store');
    }

    public function store(BlogPost $post, StoreComment $request) {

       $comment =  $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

       event(new CommentPostedEvent($comment));


        request()->session()->flash('status','comments added Successfully!!!');
        return redirect()->back();
    }
}
