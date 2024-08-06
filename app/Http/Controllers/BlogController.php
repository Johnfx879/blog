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
    public function create(blog $blog)
    {
        return view('blogs.create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string',  
            'status' => 'required|string',
        ]);

        Blog::create($request->all());

        return redirect()->route('blog.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateblogRequest $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:20',
            'content' => 'required|string',
            'status' => 'required|string',
        ]);

        $blog->update($request->all());

        return redirect()->route('blogs.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Post deleted successfully.');
    }
}
