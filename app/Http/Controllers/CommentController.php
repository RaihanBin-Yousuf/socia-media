<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id']=auth()->id();
        if(!isset($input['comment'])) return Redirect()->back();
        Comment::create($input);
        $comment = Comment::where('post_id', $input['post_id'])->count();
        // $notification = array('messege' => 'Comment created Successfully','alert-type' => 'success');
        // return Redirect()->back()->with($notification);
        return response()->json($comment);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $input['post_id']=$request->input('post_id');
        $comments = Comment::where(['post_id'=>$input['post_id']])
        ->with('user:id,created_at,name,profile_img')
        ->select(['id', 'user_id', 'post_id', 'created_at', 'comment'])
        ->get();
        foreach ($comments as $comment) {
            $comment->user->commentprofile_img = setImage($comment->user->profile_img, 'user');
            // $post->image = $post->image ? setImage($post->image) : null;           
        }
        return response()->json($comments);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
