<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostRequest;
use App\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Post::class);

        $posts = Post::with('user')
            ->where('status', Post::PUBLISHED)
            ->unless(auth()->user()->isAdmin(), function($q) {
                $q->where('user_id', auth()->id());
            })->paginate(15);

        $drafts = Post::where('status', Post::DRAFT)->where('user_id', auth()->id())->count();

        return view('admin.posts.index', compact('posts', 'drafts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('admin.posts.create', [
            'categories' => Category::select('name','id')->get()->pluck('name','id'),
            'tags' => Tag::select('tag','id')->get()->pluck('tag','id'),
        ]);
    }

    public function store(CreatePostRequest $request)
    {
        $campos = $request->validated();

        if($request->hasFile('image')) {
            $campos['image'] = $request->file('image')->store('image', 'public');
        }

        $post = $request->user()->posts()->create($campos);

        if (isset($request->tags)){
            $post->tags()->syncWithoutDetaching($request->tags);
        }

        return back()->with(['success' => "Post: {$post->tile} created succesfully"]);
    }

    /**
     * @param \App\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::select('name','id')->get()->pluck('name','id'),
            'tags' => Tag::select('tag','id')->get()->pluck('tag','id'),
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $campos = $request->validated();

        if(request()->hasFile('image')) {
            Storage::delete($post->image);
            $campos['image'] = $request->file('image')->store('image', 'public');
        }

        $post->fill($campos)->save();

        if (isset($request->tags)){
            $post->tags()->syncWithoutDetaching($request->tags);
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

    public function draft()
    {
        $drafts = Post::with('user')
            ->where('status', Post::DRAFT)
            ->where('user_id', auth()->id())
            ->paginate(15);

        $posts = Post::where('status', Post::PUBLISHED)->unless(auth()->user()->isAdmin(), function($q) {
            $q->where('user_id', auth()->id());
        })->count();

        return view('admin.posts.draft', compact('posts', 'drafts'));
    }

    public function kill(Post $post)
    {
        $post->forceDelete();

        return back()->with(['success' => "La publicación: {$post->title}  fue borrada de forma permanente."]);
    }

    public function trashed()
    {
        $trashs = Post::with('user')->onlyTrashed()->paginate(15);

        return view('admin.posts.trashed', compact('trashs'));
    }

    public function restore(Post $post)
    {
        $post->restore();

        return back()->with(['success' => 'La publicación: {$post->title}  fue restaurada correctamente.']);
    }
}
