@extends('layouts.app')

@section('title', 'Latest News')

@section('content')
    <h1 class="h3 mb-3">Latest News</h1>

    <div class="row g-2 mb-4">
        <div class="col-md-8">
            <input type="search" id="search" class="form-control" placeholder="Search articles by title...">
        </div>
        <div class="col-md-4">
            <select id="category" class="form-select">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="article-list">
        @foreach ($articles as $article)
            <div class="col article-item"
                 data-title="{{ \Illuminate\Support\Str::lower($article->title) }}"
                 data-category="{{ $article->category->name }}">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <span class="badge text-bg-primary align-self-start mb-2">{{ $article->category->name }}</span>
                        <h2 class="h5 card-title">
                            <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <p class="card-text text-muted">{{ $article->summary }}</p>
                        <p class="card-text mt-auto mb-0">
                            <small class="text-muted">
                                {{ $article->author }} &middot; {{ $article->published_at?->format('d M Y') }}
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <p id="no-results" class="text-center text-muted mt-5 d-none">No articles match your search.</p>
@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('search');
    const categorySelect = document.getElementById('category');
    const items = document.querySelectorAll('.article-item');
    const noResults = document.getElementById('no-results');

    function filterArticles() {
        const query = searchInput.value.toLowerCase().trim();
        const category = categorySelect.value;
        let visible = 0;

        items.forEach(item => {
            const matchesTitle = item.dataset.title.includes(query);
            const matchesCategory = !category || item.dataset.category === category;
            const show = matchesTitle && matchesCategory;
            item.classList.toggle('d-none', !show);
            if (show) visible++;
        });

        noResults.classList.toggle('d-none', visible > 0);
    }

    searchInput.addEventListener('input', filterArticles);
    categorySelect.addEventListener('change', filterArticles);
</script>
@endpush