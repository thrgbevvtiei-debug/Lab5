@extends('layouts.app')

@section('title', $blog->t_title)

@section('content')
    <h1>{{ $blog->t_title }}</h1>
    <p class="text-muted">
        {{ $blog->category?->category_name ?? 'Без категорії' }}
        · {{ $blog->author?->name ?? 'Редакція' }}
        · {{ $blog->dt_created->format('d.m.Y H:i') }}
    </p>

    @if ($blog->isFallback())
        <p class="text-warning small">
            Переклад мовою «{{ strtoupper(app()->getLocale()) }}» відсутній, показано оригінал.
        </p>
    @endif

    <p class="lead">{{ $blog->t_description }}</p>
    <div style="white-space: pre-line">{{ $blog->t_text }}</div>

    <p class="mt-4">
        <a href="{{ route('blog.index') }}">← До переліку</a> ·
        <a href="{{ route('blog.edit', $blog) }}">Редагувати</a>
    </p>
@endsection
