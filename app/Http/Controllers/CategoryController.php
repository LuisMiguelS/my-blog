<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Post;

class CategoryController extends Controller
{
    /**
     * @return $this
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Category::class);

        return view('category.index')
            ->with([ 'categories' => Category::orderBy('id','DESC')->paginate(15) ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return back()->with(['success' => "¡Has creado una categoría: {$category->name} con éxito!"]);
    }

    public function show($category_slug)
    {
        $posts = Category::findBySlug($category_slug)->posts()->published();

        return view('post.search', compact('posts'));
    }

    /**
     * @param \App\Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Category $category)
    {
        $this->authorize('update', Category::class);

        return view('category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request,Category $category)
    {
        $category->fill($request->validated())->save();

        return back()->with(['success' => "¡Has actualizado la categoría: {$category->name} con éxito!"]);
    }

    /**
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', Category::class);

        $category->delete();

        return back()->with(['success' => "¡Has eliminado la categoría: {$category->name} correctamente!"]);
    }
}
