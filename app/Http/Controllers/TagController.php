<?php

namespace App\Http\Controllers;

use App\{Tag, Post};
use App\Http\Requests\TagCreateRequest;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id','DESC')->paginate(15);

        return view('tag.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    public function show($slug)
    {
        $tag = Tag::findBySlug($slug);

        $posts = $tag->posts()
            ->with(['category:id,slug'])
            ->where('status', Post::PUBLISHED)
            ->orderBy('id','DESC')
            ->paginate(15);

        return view('post.search', compact('posts'));
    }
    
    public function store(TagCreateRequest $request)
    {
        $tag = Tag::create($request->validated());

        return back()->with(['success', "La etiqueta: {$tag->name} ha sido creada con éxito."]);
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', compact('tag'));
    }

    public function update(TagCreateRequest $request, Tag $tag)
    {
        $tag->fill($request->validated())->save();

        return back()->with(['success' => "La etiqueta: {$tag->name} se ha actualizado con éxito."]);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return back()->with(['success' => "La etiqueta: {$tag->name} ha sido eliminado con éxito."]);
    }
}
