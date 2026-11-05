<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;

class BlogController extends Controller
{
    // Публічний перелік (картки)
    public function index()
    {
        $blogs = Blog::with(['category', 'author'])
            ->orderByDesc('dt_created')
            ->paginate(6);

        return view('blog.index', compact('blogs'));
    }

    // Адміністративний перелік (таблиця)
    public function admin()
    {
        $blogs = Blog::with('category')
            ->orderByDesc('dt_created')
            ->paginate(10);

        return view('blog.admin', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create', [
            'categories' => Category::orderBy('category_name')
                ->pluck('category_name', 'category_id'),
        ]);
    }

    public function store(BlogRequest $request)
    {
        $blog = Blog::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('blog.show', $blog)
            ->with('success', 'Запис створено.');
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'author']);

        return view('blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', [
            'blog'       => $blog,
            'categories' => Category::orderBy('category_name')
                ->pluck('category_name', 'category_id'),
        ]);
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated());

        return redirect()->route('blog.show', $blog)
            ->with('success', 'Запис оновлено.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.admin')
            ->with('success', 'Запис видалено.');
    }
}
