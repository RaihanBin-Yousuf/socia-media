<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthUserResource;
use App\Http\Resources\ShowCommentResource;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(Comment $comment, User $user)
    {
        $this->user = $comment;
    }

    public function index(Request $request)
    {
        //
    }
    
    public function store(Request $request)
    {
        // dd('Hello');
        $input['user_id'] = $request->input('auth()->id');
        $input = $request->all();
        if(!isset($input['comment'])) return Redirect()->back();
        Comment::create($input);
        $data = [
            'comment' => Comment::where('post_id', $input['post_id'])->count(),
            'authuser' => auth()->user(),
        ];
        // $comment = Comment::where('post_id', $input['post_id'])->count();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // dd($request->user());
        $input['post_id']=$request->input('post_id');
        $comments = Comment::where(['post_id'=>$input['post_id']])
        ->with('user:id,created_at,name,profile_img')
        ->select(['id', 'user_id', 'post_id', 'created_at', 'comment'])
        ->get();
        $data = [
            'comments' => ShowCommentResource::collection($comments),
            'authuser' => AuthUserResource::make(auth()->user()),
        ];
        // return $this->apiResponseResourceCollection(201, 'comment list', );
        // return $this->apiResponseResourceCollection(201, 'post list', ShowCommentResource::collection($posts));
        return response()->json($data);

    }

    public function test()
    {
        return('Hellooooo');
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
