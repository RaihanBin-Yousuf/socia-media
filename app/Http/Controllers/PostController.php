<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        return view('home');
    }

    public function mypost()
    {

        $myPostCondition = ['user_id' => auth()->id(), 'status' => Post::ONLYPUBLIC];
        $mypost = Post::where($myPostCondition)->with('comments')->get();
        // dd($mypost->comments);
        // dd($mypost);

        return view('timeline.mypost', compact('mypost'));
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
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $this->validate($request, [
            'image' => ['image', 'max:2048'],
            'description' => 'nullable',
            'status' => 'required',
        ]);
        if (!isset($input['image']) && !isset($input['description'])) return Redirect()->back();
        $input['user_id'] = auth()->id();
        $input['image'] = isset($input['image']) ? uploadFile($input['image'], '/posts') : null;
        Post::create($input);
        $notification = array(
            'messege' => 'Post created Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $this->validate($request, [
            'image'        => 'nullable', 'image',
            'description' => 'nullable',
            'status' => 'required',
        ]);
        $post = Post::find($id);
        $input = $request->all();
        if (!isset($input['image']) && !isset($input['description'])) return Redirect()->back();
        if ($request->hasFile('image')) {
            $input['image'] = updateFile($input['image'], '/posts');
        }
        $post->update($input);
        $updatenotification = array('messege' => 'Post updated Successfully', 'alert-type' => 'info');
        return Redirect()->back()->with($updatenotification);
        // return Redirect()->back()->with('success','post created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, $id)
    {
        Post::destroy($id);
        $notification = array(
            'messege' => 'Post Deleted',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }
}
