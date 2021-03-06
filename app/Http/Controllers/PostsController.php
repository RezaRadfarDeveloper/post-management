<?php

namespace App\Http\Controllers;

use App\Events\NewPostPosted;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
//        $this->middleware('auth')->only(['create','edit','store','update','destroy']);
    }
    public function index()
    {

        if(Auth::check() && Auth::user()->is_admin){
            $posts = BlogPost::latestWithRelations()->withTrashed()->get();
        }else {
            $posts = BlogPost::latestWithRelations()->get();
        }

//    BlogPost::latest()->withCount('comments')->get();
        return view('posts.index',
            [
                'posts'=> $posts
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {

       $validated =  $request->validated();
       $validated['user_id'] = Auth::user()->id;
       $post = BlogPost::create($validated);


       if($request->hasFile('thumbnail')) {
           $file = $request->file('thumbnail');
            $thumbNailPath = Storage::disk('public')
              ->putFileAs('thumbnails',$file,now()
              ->format('Y_m_d_H_i_s').".".$file->getClientOriginalExtension());

           $post->image()->save(
               Image::make([
                   'path' => $thumbNailPath
               ])
           );
       }

       event(new NewPostPosted($post));

        request()->session()->flash('status','Post was created Successfully!!!');

       return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Cache::remember("blog-post-{$id}", now()->addSecond(60), function () use ($id) {
            return BlogPost::latest()->with('comments','user', 'tags','comments.user')->findOrfail($id);
        });

        $counterKey = "blog-post-{$id}-counter";
        $userKey = "blog-post-{$id}-users";
        $sessionId = session()->getId();
        $now = now();
        $users = Cache::get($userKey,[]);
        $updatedUsers = [];
        $difference = 0;

        foreach($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit) >= 1) {
                    $difference --;
            } else {
                $updatedUsers [$session] = $lastVisit;
            }
        }

        if(!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }
        $updatedUsers[$sessionId] = $now;

            if(!Cache::has($userKey))
                Cache::forever($userKey, 0);
            Cache::forever($userKey, $updatedUsers);

            $counter = Cache::increment($counterKey,$difference);

        return view('posts.show',['post'=>$post, 'counter' => $counter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post =  BlogPost::findOrfail($id);
        $this->authorize($post);

        return view('posts.edit',['post'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrfail($id);

        $this->authorize($post);
        $validated =  $request->validated();
        $post->fill($validated);
        if($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $thumbNailPath = Storage::disk('public')
                ->putFileAs('thumbnails',$file,now()
                        ->format('Y_m_d_H_i_s').".".$file->getClientOriginalExtension());
            if($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $thumbNailPath;
                $post->image->save();
            }
            else {
                $post->image()->save(
                    Image::make([
                        'path' => $thumbNailPath
                    ])
                );
            }
        }

        $post->save();

        $request->session()->flash('status', 'post was updated successfully');

        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrfail($id);
        $this->authorize($post);

        $post->delete();

    session()->flash('status','Post was deleted successfully!');

    return redirect()->route('posts.index');
    }
}
