<?php

namespace Foro\Http\Controllers;

use Illuminate\Http\Request;

use Foro\Http\Requests;
use Foro\Http\Controllers\Controller;

use Foro\User;
use Foro\Message;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user, $id)
    {
        $user = User::findOrFail($id);
        $messages = Message::get();
        return view('users.messages', compact('user', 'messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($receive, $sent)
    {
        $request = \Request::all();
        $message = new Message([
            'message' => $request['message'],
            'receive_id' => $receive
        ]);
        $message->sent_id = $sent;
        $message->save();

        return \Redirect::back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        return view('users.message', compact('message'));
    }

}
