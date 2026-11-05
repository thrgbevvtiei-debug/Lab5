@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    <style>
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin: 24px 0;
        }
        .blog-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
            background: #fff;
        }
        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, .12);
        }
        .blog-card-image { width: 100%; height: 180px; object-fit: cover; }
        .blog-card-body { padding: 16px; }
        .blog-category { font-size: 13px; color: #2563eb; }
        .blog-meta { font-size: 13px; color: #666; }
    </style>

    <h1>Блог</h1>
    <p><a href="{{ route('blog.admin') }}">Адміністрування</a></p>

    <div class="blog-grid">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog])
        @empty
            <p>Записів поки немає.</p>
        @endforelse
    </div>

    {{ $blogs->links() }}
@endsection
