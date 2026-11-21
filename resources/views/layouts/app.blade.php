<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daily News MY') | Daily News MY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .article-card { transition: transform .15s ease, box-shadow .15s ease; }
        .article-card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .12) !important; }
        .article-body p { line-height: 1.8; font-size: 1.05rem; }
        .site-header { z-index: 50; }
        .header-search { flex: 1 1 100%; }
        @media (min-width: 768px) {
            .header-search { flex: 0 0 320px; margin-left: auto; }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="navbar navbar-dark bg-dark sticky-top shadow-sm site-header">
        <div class="container d-flex flex-wrap align-items-center gap-2 gap-md-3">
            <a class="navbar-brand fw-bold mb-0 me-0" href="{{ route('articles.index') }}">
                Daily News <span class="text-warning">MY</span>
            </a>
            <span class="navbar-text small py-0">{{ now()->format('l, j F Y') }}</span>

            @hasSection('header-search')
                <div class="header-search">
                    @yield('header-search')
                </div>
            @endif
        </div>
    </header>

    <main class="container py-4 pb-5 flex-grow-1">
        @yield('content')
    </main>

    <footer class="bg-dark text-secondary text-center small py-4 mt-auto">
        <div class="container">
            &copy; {{ date('Y') }} Daily News MY
        </div>
    </footer>

    @stack('scripts')
</body>
</html>