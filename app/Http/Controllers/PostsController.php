<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Auth;
use App\Category;
use App\Post;
use App\Tag;

class PostsController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', ['posts' => Post::all()]);
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        //Si no hay categorias agregadas, impido la creacion de un post
        if($categories->count() == 0 || $tags->count() == 0)
        {
            Session::flash('info', 'You must have some categories and tags before attempting to create a post.');
            return redirect()->back();
        }

        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'featured' => 'required|image:',
            'content' => 'required',
            'category_id' => 'required',
            'tags' => 'required'
        ]);

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName(); //La hora concatenado con el nombre original del archivo
        $featured->move('uploads/posts', $featured_new_name); //Moviendo la imagen a la carpeta: "public/uploads/posts"

        $post = Post::create([
            'title' => $request->title,
            'featured' => 'uploads/posts/'.$featured_new_name,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'slug' => str_slug($request->title),
            'user_id' => Auth::id()
        ]);

        /*El metodo attach() solo esta disponible para tablas intermedias.
        Este metodo insertará automaticamente los id de del post procesado y de los tags*/
        $post->tags()->attach($request->tags);

        Session::flash('success', 'Post created succesfully');

        return redirect()->route('posts');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        if(empty($post))
        {
            Session::flash('info', 'You must restore this post before edit it.');
            return redirect()->back();
        }

        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'tags' => Tag::all()]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        //Si el usuario sube una imagen nueva
        if($request->hasFile('featured'))
        {
            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);

            $post->featured = 'uploads/posts/'.$featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        $post->save();

        //El metedo sybcs() recibe un array y actualiza la tabla intermedia
        $post->tags()->sync($request->tags);

        Session::flash('success', 'The post has been updated successfully.');

        return redirect()->route('posts');
    }

    public function destroy($id)
    {
        $post = Post::find($id); 
        $post->delete();

        Session::flash('success', 'The post was just trashed.');

        return redirect()->route('posts');
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        Session::flash('success', 'Post deleted permanently.');

        return redirect()->route('posts.trashed');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed', ['posts' => $posts]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        Session::flash('success', 'The post has been restored successfully.');

        return redirect()->route('posts');
    }
}
