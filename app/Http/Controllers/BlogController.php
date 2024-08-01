<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Blog $post)
    {
        return view('blogs.create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogRequest $request)
    {
        $request->validate([
            'tittle' => 'required|text|max:25',
            'content' => 'required|text',
            'status' => 'required|string',
        ]);

        $post = Blog::create($request->all());

        return redirect()->route('blogs.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateblogRequest $request, blog $blog)
    {
        $request->validate([
            'tittle' => 'required|text|max:25',
            'content' => 'required|text',
            'status' => 'required|string',
        ]);

        $blog->update($request->all());

        return redirect()->route('blogs.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Post deleted successfully.');
    }
}
