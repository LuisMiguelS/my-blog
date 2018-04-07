<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;
use App\Http\Requests\PostEditRequest;
use App\Http\Requests\PostCreateRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', ['posts' => Post::paginate(15)]);
    }

    public function create()
    {
        $categories = Category::select('name','id')->get()->pluck('name','id');
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostCreateRequest $request)
    {
        if (!request()->tags){
            return back()->with(['info' => "Debes indicar al menos 1 tag"]);
        }

        $campos = $request->validated();
        $campos['thumbnails'] = request()->file('thumbnails')->store('thumbnails', 'public');

        $post = auth()->user()->posts()->create($campos);

        $tags = explode(',', request()->tags);

        foreach ($tags as $value) {
            $tag = Tag::firstOrCreate([
                'tag' => strtolower($value)
            ], [
                'tag' => $value
            ]);

            $post->tags()->syncWithoutDetaching($tag->id);
        }

        return back()->with(['success' => "Post: {$post->tile} created succesfully"]);
    }

    public function edit(Post $post)
    {
        $categories = Category::select('name','id')->get()->pluck('name','id');
        $tags = Tag::select('tag')->get()->pluck('tag')->implode(',');
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostEditRequest $request, Post $post)
    {
        if (!request()->tags){
            return back()->with(['info' => "Debes indicar al menos 1 tag"]);
        }

        if(request()->hasFile('thumbnails')) {
            Storage::delete($post->thumbnails);
            $post->thumbnails = request()->file('thumbnails')->store('thumbnails', 'public');
        }

        $post->fill($request->validated())->save();

        $tags = explode(',', request()->tags);

        foreach ($tags as $value) {
            $tag = Tag::firstOrCreate([
                'tag' => strtolower($value)
            ], [
                'tag' => $value
            ]);

            $post->tags()->syncWithoutDetaching($tag->id);
        }

        return back()->with(['success' => "La publicación: {$post->title}  se ha actualizado con éxito."]);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with(['success' => 'The post was just trashed.']);
    }

    public function kill($id)
    {
//        $post = Post::withTrashed()->where('id', $id)->first();
//        $post->forceDelete();
//
//        Session::flash('success', 'Post deleted permanently.');
//
//        return route('posts.trashed');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed', compact('posts'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return back()->with(['success' => 'The post has been restored successfully.']);
    }
}
