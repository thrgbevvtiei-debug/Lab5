<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogTranslationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Blog::all() as $blog) {
            $blog->translations()->updateOrCreate(
                ['locale' => 'en'],
                [
                    'title'       => 'Blog post #' . $blog->blog_id,
                    'description' => 'Short summary of post #' . $blog->blog_id . ' about our car dealership.',
                    'text'        => 'Full text of post #' . $blog->blog_id . '. This is an English translation.',
                ]
            );
        }
    }
}
