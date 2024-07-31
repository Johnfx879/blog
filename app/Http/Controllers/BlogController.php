<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Blog::paginate(10);
        return view('post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Blog $post)
    {
        return view('post.create', compact('post'));
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

        return redirect()->route('blog.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        return view('post.edit', compact('post'));
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Post deleted successfully.');
    }
}
