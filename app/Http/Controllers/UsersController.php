<?php

namespace Foro\Http\Controllers;

use Illuminate\Http\Request;

use Foro\Http\Requests;
use Foro\Http\Controllers\Controller;

use Foro\User;
use Foro\Post;
use Foro\Comment;
use Foro\Message;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')->paginate(20);
        return view('users.all', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $id)
    {
        $user = User::findOrFail($id);

        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user, $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $id)
    {
        $user = User::findOrFail($id);

        $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$user->id,
            'user' => 'required|max:50|unique:users,email,'.$user->id,
            'sex' => 'required',
            'country' => 'required'
        );
        $validate = \Validator::make($request->all(), $rules);
        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->user = $request['user'];
        $user->sex = $request['sex'];
        $user->country = $request['country'];
        $user->slogan = $request['slogan'];
        $user->birthdate = $request['birthdate'];
        $user->website_url = $request['website_url'];

        if($request->file('picture') != null)
        {
            $pic = array('image' => $request->file('picture'));
            $pic_rules = array('image' => 'mimes:jpg,jpeg,png,gif');
            $validation = \Validator::make($pic, $pic_rules);
            if ($validation->fails())
            {
                return redirect()->back()->withErrors($validation)->withInput();
            }
            $file = $request->file('picture');
            $nombre = $file->getClientOriginalName();
            \Storage::disk('local')->put($nombre,  \File::get($file));
            $user->picture = 'uploads/'.$nombre;
        }

        $user->save();

        return redirect()->route('profile', [$user->user, $user->id]);
    }

    public function userTopics($user, $id)
    {
        $user = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->get();
        return view('users.personaltopics', compact('user', 'posts'));
    }

    public function admin()
    {
        $users = User::paginate(20);
        return view('admin.privileges', compact('users'));
    }

    public function users($id)
    {
        $user = User::findOrFail($id);
        return view('admin.roles', compact('user'));
    }

    public function role($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->role = $request['role'];
        $user->password = $request['password'];
        $user->save();

        return redirect()->route('users');
    }

}
