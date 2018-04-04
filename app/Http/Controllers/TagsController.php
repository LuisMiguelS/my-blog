<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Tag;

class TagsController extends Controller
{
    public function index()
    {
        return view('admin.tags.index', ['tags' => Tag::all()]);
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tag' => 'required'
        ]);

        Tag::create([
            'tag' => $request->tag
        ]);

        Session::flash('success', 'The tag has been created successfully.');

        return redirect()->route('tags');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', ['tag' => $tag]);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);

        $this->validate($request, [
            'tag' => 'required'
        ]);

        $tag->tag = $request->tag;
        $tag->save();

        Session::flash('success', 'The tag has been updated successfully.');

        return redirect()->route('tags');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        Session::flash('success', 'The tag has been deleted successfully.');

        return redirect()->route('tags');
    }
}
