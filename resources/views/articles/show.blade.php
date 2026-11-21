@extends('layouts.app')

@section('title', $article->title)

@section('content')
    @php $color = $article->category->color; @endphp

    <a href="{{ route('articles.index') }}" class="text-decoration-none">&larr; Back to all articles</a>

    <article class="bg-white rounded shadow-sm p-4 p-md-5 mt-3"
             style="border-top: 4px solid var(--bs-{{ $color }});">
        <span class="badge text-bg-{{ $color }} mb-3">{{ $article->category->name }}</span>
        <h1 class="display-6 fw-bold mb-3">{{ $article->title }}</h1>

        <div class="d-flex align-items-center gap-3 text-muted mb-4">
            <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold"
                 style="width: 44px; height: 44px;">
                {{ \Illuminate\Support\Str::of($article->author)->explode(' ')->map(fn ($n) => mb_substr($n, 0, 1))->take(2)->implode('') }}
            </div>
            <div class="small">
                <div class="fw-semibold text-dark">{{ $article->author }}</div>
                <div>
                    {{ $article->published_at?->format('d F Y') }}
                    &middot; {{ $article->reading_time }} min read
                </div>
            </div>
        </div>

        <p class="lead fw-semibold">{{ $article->summary }}</p>
        <hr>

        <div class="article-body">
            @foreach (preg_split('/\n{2,}/', $article->body) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </article>

    @if ($related->isNotEmpty())
        <h2 class="h5 fw-bold mt-5 mb-3">More in {{ $article->category->name }}</h2>
        <div class="row g-4">
            @foreach ($related as $item)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm article-card"
                         style="border-top: 4px solid var(--bs-{{ $color }}) !important;">
                        <div class="card-body">
                            <h3 class="h6 card-title">
                                <a href="{{ route('articles.show', $item) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <small class="text-muted">{{ $item->published_at?->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection