<?php

namespace App\Http\Controllers;

use App\{Tag, Post};
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Tag::class);

        $tags = Tag::orderBy('id','DESC')->paginate(15);

        return view('tag.index', compact('tags'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Tag::class);

        return view('tag.create');
    }

    public function show($slug)
    {
        $tag = Tag::findBySlug($slug);

        $posts = $tag->posts()->published();

        $search =  ['q' => $tag->tag];

        return view('post.search', compact('posts', 'search'));
    }
    
    public function store(CreateTagRequest $request)
    {
        $tag = Tag::create($request->validated());

        return back()->with(['success' => "La etiqueta: {$tag->tag} ha sido creada con éxito."]);
    }

    /**
     * @param \App\Tag $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', Tag::class);

        return view('tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();

        return back()->with(['success' => "La etiqueta: {$tag->tag} se ha actualizado con éxito."]);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', Tag::class);

        $tag->delete();

        return back()->with(['success' => "La etiqueta: {$tag->tag} ha sido eliminado con éxito."]);
    }
}
