<article class="blog-card">
    <a href="{{ route('blog.show', $blog) }}">
        <img src="{{ asset('images/blog-placeholder.svg') }}"
             alt="{{ $blog->t_title }}"
             class="blog-card-image">
    </a>
    <div class="blog-card-body">
        <span class="blog-category">
            {{ $blog->category?->category_name ?? 'Без категорії' }}
        </span>
        <h2 class="h5 mt-1">
            <a href="{{ route('blog.show', $blog) }}">{{ $blog->t_title }}</a>
        </h2>
        <p class="blog-meta">
            Автор: {{ $blog->author?->name ?? 'Редакція' }}
            · {{ $blog->dt_created->format('d.m.Y') }}
        </p>
        <p>{{ \Illuminate\Support\Str::limit($blog->t_description, 120) }}</p>
        <a href="{{ route('blog.show', $blog) }}">Читати далі →</a>
    </div>
</article>
