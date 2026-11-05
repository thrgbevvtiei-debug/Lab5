@extends('layouts.app')

@section('title', 'Переклади авто')

@section('content')
    <h1 class="h3">Переклади: {{ $car->brand }} {{ $car->model }}</h1>

    <form method="POST" action="{{ route('cars.translations.update', $car) }}">
        @csrf
        @method('PUT')

        @foreach ($locales as $code => $name)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $name }} ({{ $code }})
                    @if ($code === config('app.fallback_locale'))
                        <span class="badge bg-secondary">основна</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="title_{{ $code }}">Заголовок</label>
                        <input type="text" class="form-control" id="title_{{ $code }}"
                               name="translations[{{ $code }}][title]"
                               value="{{ old("translations.$code.title", $translations[$code]->title ?? '') }}">
                        @error("translations.$code.title")
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="desc_{{ $code }}">Опис</label>
                        <textarea class="form-control" rows="4" id="desc_{{ $code }}"
                                  name="translations[{{ $code }}][description]">{{ old("translations.$code.description", $translations[$code]->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('cars.show', $car) }}" class="btn btn-link">Скасувати</a>
    </form>
@endsection
