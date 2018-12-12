<?php

namespace Foro\Http\Controllers;

use Illuminate\Http\Request;

use Foro\Http\Requests;
use Foro\Http\Controllers\Controller;

use Foro\Post;
use Foro\Ad;

class HomeController extends Controller
{
    public function index()
    {
    	$posts = Post::select('id', 'title', 'category_id', 'user_id', 'type')
    	->orderBy('updated_at', 'DESC')
    	->paginate(15);

    	$ads = Ad::get();

    	return view('home', compact('posts', 'ads'));
    }
}
