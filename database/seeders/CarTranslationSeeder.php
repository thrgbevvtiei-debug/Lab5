<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarTranslationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Car::all() as $car) {
            $name    = trim("{$car->brand} {$car->model}");
            $mileage = number_format($car->mileage, 0, '.', ' ');
            $fuel    = $car->fuel_type->value;
            $gear    = $car->transmission->value;

            $car->translations()->updateOrCreate(
                ['locale' => 'uk'],
                [
                    'title'       => "{$name}, {$car->year} рік",
                    'description' => "Автомобіль {$name} {$car->year} року випуску. "
                        . "Пробіг {$mileage} км, паливо: {$fuel}, коробка передач: {$gear}. "
                        . "Доглянутий, готовий до огляду та тест-драйву в нашому автосалоні.",
                ]
            );

            $car->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'title'       => "{$name}, {$car->year}",
                    'description' => "{$name}, model year {$car->year}. "
                        . "Mileage {$mileage} km, fuel: {$fuel}, transmission: {$gear}. "
                        . "Well maintained and ready for a viewing and test drive at our car dealership.",
                ]
            );
        }
    }
}
