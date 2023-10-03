<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Project;
use App\Models\Role;
use App\Notifications\NewPostNotifi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{

    private function responsePlaceholder(){
        return [
            'result' => 'success',
            'url' => redirect()->back()->getTargetUrl()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Project $project, Request $request)
    {
        $user = Auth::user();
        $curTab = $request->tab;
        return view('post.form', compact('user', 'project', 'curTab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $post= Post::create($data);
        $post->notifiUsers($post);
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     */
    public function edit(Post $post)
    {
        $user = Auth::user();
        return view('post.form', compact('user', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     */
    public function update(PostRequest $request)
    {
        $data = $request->validated();
        $post = Post::where('id', $request->id)->first()->fill($data);
        if($post->isDirty('role_id')){
            $post->notifiUsers($post);
        }
        $post->save();
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    public function restore(Post $post)
    {
        $post->restore();
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    public function uploadImg(Request $request){
        try {
            $fileName=uniqid('', true);
            $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
            return response()->json(['location'=>env("APP_URL")."/storage/$path"]);
        } catch (Throwable $e) {
            return response()->json(['err'=>$e->getMessage()]);
        }

    }

    public function search(Request $request){
        $q = $request->query('q');
        $user = Auth::user();
        $posts = Post::search($q)
            ->get()
            ->whereIn('role_id', [...$user->roles->pluck('id'), '777', '666'])
            ->filter(function($item) use ($user) {
                if ($item->role_id != '666' || ($item->role_id == '666' && $item->user_id == $user->id)) {
                    return $item;
                }
            }
            );
        return view('search', compact('posts', 'user'));
    }

    private function getUsersForNotification(Post $post){
        return $post->project->users
            ->filter(fn ($user) => $user->id != Auth::user()->id)
            ->filter(fn ($user) => $user->roles->pluck('id')
                ->contains($post->role_id));
    }
}
