<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoController extends Controller
{


    public function index(Request $request, $id = null)
    {

    }

    public function mypost()
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Post $post, $id)
    {

    }
}
