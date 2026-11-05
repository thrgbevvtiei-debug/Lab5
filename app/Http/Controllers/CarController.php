<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::query()->withTranslation();

        // Фільтрація: якщо brand немає в запиті, показуємо всі авто
        if ($request->filled('brand')) {
            $query->where('brand', $request->query('brand'));
        }

        // withQueryString() зберігає ?brand=... при переході між сторінками
        $cars = $query->orderBy('brand')
            ->orderBy('model')
            ->paginate(5)
            ->withQueryString();

        $brands = Car::query()->distinct()->orderBy('brand')->pluck('brand');

        return view('cars.index', compact('cars', 'brands'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(CarRequest $request)
    {
        Car::create($request->validated());

        return redirect()->route('cars.index')->with('success', 'Авто успішно додано.');
    }

    public function show(Car $car)
    {
        $car->load([
            'translations' => fn ($q) => $q->whereIn(
                'locale',
                array_unique([app()->getLocale(), config('app.fallback_locale')])
            ),
        ]);

        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(CarRequest $request, Car $car)
    {
        $car->update($request->validated());

        return redirect()->route('cars.index')->with('success', 'Дані авто оновлено.');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Авто видалено.');
    }
}
