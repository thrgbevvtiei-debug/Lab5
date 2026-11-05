@extends('layouts.app')

@section('title', 'Новий запис')

@section('content')
    <h1>Новий запис</h1>
    <form method="POST" action="{{ route('blog.store') }}">
        @csrf
        @include('blog._form')
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('blog.admin') }}" class="btn btn-link">Скасувати</a>
    </form>
@endsection
