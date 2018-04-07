<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagCreateRequest;
use App\Tag;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.tags.index', ['tags' => Tag::paginate(15)]);
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagCreateRequest $request)
    {
        $tag = Tag::create($request->validated());

        return back()->with(['success', "La etiqueta: {$tag->name} ha sido creada con éxito."]);
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
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
