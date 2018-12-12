<?php

namespace Foro\Http\Controllers;

use Illuminate\Http\Request;

use Foro\Http\Requests;
use Foro\Http\Controllers\Controller;

use Foro\Comment;

class CommentsController extends Controller
{
    public function store($id)
    {
        $request = \Request::all();

        $comment = new Comment([
            'comment' => $request['comment'],
            'user_id' => $request['user_id']
        ]);
        $comment->post_id = $id;
        $comment->save();

        return \Redirect::back();
    }

    public function update($id)
    {
        $comment = Comment::findOrFail($id);

        return view('topics.edit-comment', compact('comment'));
    }

    public function postUpdate(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back();
    }
}
