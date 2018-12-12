<?php

namespace Foro\Http\Controllers;

use Illuminate\Http\Request;

use Foro\Http\Requests;
use Foro\Http\Controllers\Controller;

use Foro\Category;
use Foro\Post;
use Foro\Comment;
use Foro\Like;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'category', 'img')
        ->orderBy('category', 'ASC')
        ->with('posts')->paginate(20);

        return view('topics.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $rules = array(
                    'title'    => 'required|max:255',
                    'body'     => 'required',
                    'category' => 'required',
                    'type'     => 'required',
        );

        $validate = \Validator::make($request->all(), $rules);

        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $file_name= $request->get('file_name');

        if(!is_null($file_name))
        {
            $post = new Post([
                'title'       => $request['title'],
                'body'        => $request['body'],
                'category_id' => $request['category'],
                'type'        => $request['type'],
                'name'        => $file_name,
                'path'        => 'uploads/'.$file_name
            ]);
        }
        else
        {
            $post = new Post([
                'title'       => $request['title'],
                'body'        => $request['body'],
                'category_id' => $request['category'],
                'type'        => $request['type']
            ]);
        }

        $post->user_id = Auth::user()->id;
        $post->save();

        $category = Category::findOrFail($post->category_id);

        return redirect()->route('topic', [$category->category, $post->id]);
    }

    public function store_file(Request $request){

        \JildertMiedema\LaravelPlupload\Facades\Plupload::receive('file', function ($file)
        {
            $file->move(public_path() . '/uploads/', $file->getClientOriginalName());

            return 'ready';
        });
    }

    public function newPost($id)
    {
        $categories = Category::get();
        return view('topics.new-archive', compact('categories'));

    }

    public function topic($category, $id)
    {
        $post = Post::findOrFail($id);
        $like = Like::where('post_id', $id)->where('user_id', \Auth::user()->id)->get();
        $comments = Comment::where('post_id', $id)->get();
        return view('topics.one', compact('post', 'comments', 'like'));
    }

    public function category()
    {
        $request = \Request::all();
        $category = new Category([
            'category' => $request['category']
        ]);
        $category->save();

        return \Redirect::back();
    }

    public function admin()
    {
        $categories = Category::paginate(10);
        return view('admin.posts', compact('categories'));
    }

    public function modify($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category', compact('category'));
    }

    public function modified($id, Request $request)
    {
        $category = Category::findOrFail($id);

        if($request->file('picture') != null)
        {
            if ($category->img != null)
            {
                unlink(public_path().'/'.$category->img);
            }
            $pic = array('image' => $request->file('picture'));
            $pic_rules = array('image' => 'mimes:png,jpeg,gif');
            $validation = \Validator::make($pic, $pic_rules);

            if ($validation->fails())
            {
                return redirect()->back()->withErrors($validation)->withInput();
            }

            $file = $request->file('picture');
            $nombre = $file->getClientOriginalName();
            \Storage::disk('local')->put($category->category,  \File::get($file));

            $category->category = $request['category'];
            $category->img = 'uploads/'.$nombre;
        }
        else
        {
            $category->category = $request['category'];
        }

        $category->save();

        return redirect()->route('categories');
    }

    public function like($id)
    {
        $like = new Like([
            'user_id' => \Auth::user()->id,
            'post_id' => $id
        ]);
        $like->save();

        $likes = Like::where('post_id', $id)->get();

        $post = Post::findOrFail($id);
        $post->likes = count($likes);
        $post->save();

        return redirect()->back();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::get();

        if (\Gate::allows('update-post', $post))
        {
            return view('topics.edit', compact('post', 'categories'));
        }
        else
        {
            return redirect()->route('home')->withErrors('Usted no tiene permisos para modificar este tema');
        }
    }

    public function postEdit(Request $request, $id)
    {
        $rules = array(
            'category' => 'required',
            'type'     => 'required'
        );

        $validate = \Validator::make($request->all(), $rules);

        if ($validate->fails())
        {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->type = $request->type;
        $post->save();

        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        if ($request->word != null)
        {
            $posts = Post::where('title', 'like', '%'.$request->word.'%')->get();

            return view('topics.search', compact('posts'));
        }

        return redirect()->route('all');
    }

    public function delete($i)
    {
        Post::destroy($i);

        return redirect()->back();
    }

}
