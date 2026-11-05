@extends('layouts.app')

@section('title', 'Редагування запису')

@section('content')
    <h1>Редагування запису</h1>
    <form method="POST" action="{{ route('blog.update', $blog) }}">
        @csrf
        @method('PUT')
        @include('blog._form')
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('blog.admin') }}" class="btn btn-link">Скасувати</a>
    </form>
@endsection
