@extends('layouts.app')

@section('title', 'Latest News')

@section('header-search')
    <input type="search" id="search" class="form-control form-control-sm" placeholder="Search by title...">
@endsection

@section('content')
    <div class="mb-3">
        <h1 class="h3 fw-bold mb-1">Latest News</h1>
        <p class="text-muted mb-0">Headlines from around Malaysia</p>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-4" id="category-pills">
        <button type="button" class="btn btn-sm btn-dark" data-category="">All</button>
        @foreach ($categories as $category)
            <button type="button" class="btn btn-sm btn-outline-dark" data-category="{{ $category->name }}">
                {{ $category->name }}
            </button>
        @endforeach
    </div>

    <div class="row g-4">
        @foreach ($articles as $article)
            @php $color = $article->category->color; @endphp
            <div class="col-12 col-md-6 col-lg-4 article-item"
                 data-title="{{ \Illuminate\Support\Str::lower($article->title) }}"
                 data-category="{{ $article->category->name }}">
                <div class="card h-100 border-0 shadow-sm article-card bg-white"
                     style="border-top: 4px solid var(--bs-{{ $color }}) !important;">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge text-bg-{{ $color }}">{{ $article->category->name }}</span>
                        </div>
                        <h2 class="h5 card-title">
                            <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <p class="card-text text-muted">{{ $article->summary }}</p>
                        <p class="card-text mt-auto mb-0">
                            <small class="text-muted">
                                {{ $article->author }}
                                &middot; {{ $article->published_at?->diffForHumans() }}
                                &middot; {{ $article->reading_time }} min read
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
    const pills = document.querySelectorAll('#category-pills button');
    const items = document.querySelectorAll('.article-item');
    const noResults = document.getElementById('no-results');
    let selectedCategory = '';

    function filterArticles() {
        const query = searchInput.value.toLowerCase().trim();
        let visible = 0;

        items.forEach(item => {
            const matchesTitle = item.dataset.title.includes(query);
            const matchesCategory = !selectedCategory || item.dataset.category === selectedCategory;
            const show = matchesTitle && matchesCategory;
            item.classList.toggle('d-none', !show);
            if (show) visible++;
        });

        noResults.classList.toggle('d-none', visible > 0);
    }

    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            selectedCategory = pill.dataset.category;
            pills.forEach(p => {
                const active = p === pill;
                p.classList.toggle('btn-dark', active);
                p.classList.toggle('btn-outline-dark', !active);
            });
            filterArticles();
        });
    });

    searchInput.addEventListener('input', filterArticles);
</script>
@endpush