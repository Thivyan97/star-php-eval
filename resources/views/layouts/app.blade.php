<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'News Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('articles.index') }}">Daily News</a>
        </div>
    </nav>

    <main class="container pb-5">
        @yield('content')
    </main>

    <footer class="text-center text-muted small py-4">
        &copy; {{ date('Y') }} Daily News
    </footer>

    @stack('scripts')
</body>
</html>