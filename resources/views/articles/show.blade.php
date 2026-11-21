@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <a href="{{ route('articles.index') }}" class="text-decoration-none">&larr; Back to all articles</a>

    <article class="bg-white rounded shadow-sm p-4 p-md-5 mt-3">
        <span class="badge text-bg-primary mb-3">{{ $article->category->name }}</span>
        <h1 class="h2 mb-2">{{ $article->title }}</h1>
        <p class="text-muted">
            By {{ $article->author }} &middot; {{ $article->published_at?->format('d F Y') }}
        </p>
        <p class="lead">{{ $article->summary }}</p>
        <hr>
        @foreach (preg_split('/\n{2,}/', $article->body) as $paragraph)
            <p>{{ $paragraph }}</p>
        @endforeach
    </article>
@endsection