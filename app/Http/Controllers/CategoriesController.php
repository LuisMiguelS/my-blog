<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', ['categories' => Category::all()]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'You succesfully created a category!');

        return redirect()->route('categories');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'You succesfully updated the category!');

        return redirect()->route('categories');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('success', 'You succesfully deleted the category!');

        return redirect()->route('categories');
    }
}
