<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('test.loadmore');
    }
    public function userlist(Request $request, $id = null)
    {
        if ($request->ajax()) {
            if ($id) $users = User::where('id', '>', $id)->orderBy('id', 'ASC')->limit(3)->get();
            return response()->json($users);
        }
        $users = User::orderBy('id', 'ASC')->limit(3)->get();
        return view('test.userloadmore', compact('users'));
        //    if ($id) {
        //     $data = User::where('id','<',$id)->orderBy('id','DESC')->limit(3)->get();

        //    } else {
        //     $data = User::orderBy('id','DESC')->limit(3)->get();
        //    }

    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $user = $this->user->InsertUser($input);
        return $this->index();
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(UserRequest $request)
    {
        $input = $request->validated();
        $user = auth()->user();
        if ($request->hasFile('profile_img')) {
            $input = $request->validated();
            $profile_picture = updateFile($input['profile_img'], 'profile', $user->profile_img);
            $user->profile_img = $profile_picture;
            $user->update();
        }
        $user->update([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'address' => $input['address'],
        ]);
        //    dd($input);
        $notification = array(
            'messege' => 'Profile Updated Successfully ',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function deleteUserById($id)
    {
        $users = Auth::user($id);
        $users->delete();
        $notification = array(
            'messege' => 'Profile Deleted Successfully ',
            'alert-type' => 'success'
        );
        return redirect(route('/'))->with($notification);
    }
}
