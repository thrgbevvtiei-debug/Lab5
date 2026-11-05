@extends('layouts.app')

@section('title', $blog->title)

@section('content')
    <h1>{{ $blog->title }}</h1>
    <p class="text-muted">
        {{ $blog->category?->category_name ?? 'Без категорії' }}
        · {{ $blog->author?->name ?? 'Редакція' }}
        · {{ $blog->dt_created->format('d.m.Y H:i') }}
    </p>

    <p class="lead">{{ $blog->description }}</p>
    <div style="white-space: pre-line">{{ $blog->text }}</div>

    <p class="mt-4">
        <a href="{{ route('blog.index') }}">← До переліку</a> ·
        <a href="{{ route('blog.edit', $blog) }}">Редагувати</a>
    </p>
@endsection
