<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $sort_by = $request->input('sort_by', 'created_at');
        $sort_order = $request->input('sort_order', 'asc');

        $blogs = Blog::query()
            ->search($search)
            ->when($status && $status !== 'default', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy($sort_by, $sort_order)
            ->paginate(10);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogRequest $request)
    {
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
        $blog->update($request->validated());

        return redirect()->route('blog.index')->with('success', 'Post updated successfully.');
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
