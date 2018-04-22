<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryEditRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', ['categories' => Category::paginate(15)]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        $category = Category::create($request->validated());

        return back()->with(['success' => "¡Has creado una categoría: {$category->name} con éxito!"]);
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryEditRequest $request,Category $category)
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
        $category->delete();

        return back()->with(['success' => "¡Has eliminado la categoría: {$category->name} correctamente!"]);
    }
}
