<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $input['post_id']=$request->input('post_id');
        $likes=Like::where(['post_id'=>$input['post_id']])
        ->with('user:id,created_at,name,profile_img')
        ->select(['id', 'user_id', 'post_id', 'created_at', 'emoji'])
        ->get();
        foreach ($likes as $like ) {
            $like->user->likeprofile_img= setImage($like->user->peofile_img,'user');
        }
        return response()->json($likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input['emoji']=$request->input('emoji');
        $input['post_id']=$request->input('post_id');
        $input['user_id']=auth()->id();
        $condition=['user_id'=>$input['user_id'],'post_id'=> $input['post_id']];
        Like::updateOrCreate($condition, ['emoji'=>$input['emoji']]);
        $like = Like::where('post_id', $input['post_id'])->count();
        return response()->json($like);
        // return back()
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
