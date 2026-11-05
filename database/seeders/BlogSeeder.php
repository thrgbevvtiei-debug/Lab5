<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [];
        foreach (['Новини', 'Тест-драйви', 'Поради'] as $name) {
            $categories[] = Category::firstOrCreate(['category_name' => $name]);
        }

        for ($i = 1; $i <= 8; $i++) {
            Blog::updateOrCreate(
                ['title' => "Навчальний запис №{$i}"],
                [
                    'description' => "Короткий опис запису №{$i} про автосалон.",
                    'text'        => "Повний текст запису №{$i}.",
                    'category_id' => $categories[($i - 1) % count($categories)]->category_id,
                    'user_id'     => null,
                ]
            );
        }
    }
}
