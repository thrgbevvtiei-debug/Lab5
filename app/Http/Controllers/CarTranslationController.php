<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarTranslationController extends Controller
{
    public function edit(Car $car)
    {
        $car->load('translations');

        return view('cars.translations', [
            'car'          => $car,
            'locales'      => config('locales'),
            'translations' => $car->translations->keyBy('locale'),
        ]);
    }

    public function update(Request $request, Car $car)
    {
        $main = config('app.fallback_locale');

        $request->validate([
            "translations.{$main}.title" => ['required', 'string', 'max:200'],
            'translations.*.title'       => ['nullable', 'string', 'max:200'],
            'translations.*.description' => ['nullable', 'string', 'max:5000'],
        ], [
            "translations.{$main}.title.required" => 'Заголовок основною мовою обовʼязковий.',
        ]);

        $input = $request->input('translations', []);

        foreach (array_keys(config('locales')) as $locale) {
            $title = trim($input[$locale]['title'] ?? '');

            // Порожній заголовок означає, що переклад цією мовою видаляється
            if ($title === '') {
                $car->translations()->where('locale', $locale)->delete();
                continue;
            }

            $car->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title'       => $title,
                    'description' => $input[$locale]['description'] ?? null,
                ]
            );
        }

        return redirect()->route('cars.show', $car)->with('success', 'Переклади збережено.');
    }
}
