<?php

namespace App\Http\Controllers;

use App\{Post, Tag, Category};
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\CreatePostRequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Post::class);

        $posts = Post::unless(auth()->user()->isAdmin(), function($q) {
                $q->where('user_id', auth()->id());
            })->published();

        $drafts = Post::where('user_id', auth()->id())
            ->CountPost(Post::DRAFT);

        return view('post.index', compact('posts', 'drafts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::select('name','id')->get()->pluck('name','id');

        $tags = Tag::select('tag','id')->get()->pluck('tag','id');

        return view('post.create', compact('categories', 'tags'));
    }

    public function show($category_slug, $post_slug)
    {
        $post = Post::with(['user:id,name','category:id,slug'])
            ->where('status', Post::PUBLISHED)
            ->findBySlug($post_slug);

        abort_unless($post->postInCategory($category_slug), Response::HTTP_NOT_FOUND);

        return view('post.show', compact('post'));
    }

    /**
     * @param \App\Http\Requests\CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        $categories = Category::select('name','id')->get()->pluck('name','id');

        $tags = Tag::select('tag','id')->get()->pluck('tag','id');

        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
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
        $this->authorize('delete', $post);

        if (!auth()->user()->owns($post) && !$post->isPublished()){
            abort(403);
        }

        $post->delete();

        return back()->with(['success' => "La publicación: {$post->title} fue simplemente destruida."]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function draft()
    {
        $this->authorize('view', Post::class);

        $drafts = Post::draft();

        $posts = Post::unless(auth()->user()->isAdmin(), function($q) {
            $q->where('user_id', auth()->id());
        })->CountPost(Post::PUBLISHED);

        return view('post.draft', compact('posts', 'drafts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function trashed()
    {
        $this->authorize('only-admin');

        $trashs = Post::trashs();

        return view('post.trashed', compact('trashs'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore($id)
    {
        $this->authorize('only-admin');

        $post = Post::findTrash($id);

        $post->restore();

        return back()->with(['success' => "La publicación: {$post->title}  fue restaurada correctamente."]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function kill($id)
    {
        $this->authorize('only-admin');

        $post = Post::findTrash($id);

        $post->forceDelete();

        return back()->with(['success' => "La publicación: {$post->title}  fue borrada de forma permanente."]);
    }
}
