<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
    public function create(Post $post)
    {
        $user = Auth::user();
        return view('comment.form', compact('user', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        Comment::create($data);
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     */
    public function edit(Comment $comment)
    {
        $user = Auth::user();
        return view('comment.form', compact('user', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        Comment::where('id', $request->id)->update($data);
        return response()->json(
            $this->responsePlaceholder()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(
            $this->responsePlaceholder()
        );
    }
}
