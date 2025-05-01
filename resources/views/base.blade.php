<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-base-200">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Freelance</title>

    @vite(['resources/js/app.ts'])
    @yield('head')
</head>
<body class="font-sans antialiased">

@if(session('success'))
    <div role="alert"
         class="alert alert-vertical alert-success sm:alert-horizontal w-max fixed top-4 right-4 max-w-100 z-50 shadow-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>{{ session('success') }}</div>
        <button class="btn btn-square btn-ghost self-start -mr-2" onclick="this.parentElement.remove()">&times;</button>
    </div>
@endif

@auth
    <header class="bg-primary text-primary-content shadow">
        <div class="container">
            <nav class="flex items-center gap-4 py-4">
                <a href="{{ route('dashboard') }}">{{ __('menu.dashboard') }}</a>
                <a href="{{ route('clients.index') }}">{{ __('menu.clients') }}</a>
            </nav>
        </div>
    </header>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @endauth

        @yield('body')

        @auth
    </div>
@endauth


@yield('script')
</body>
</html>
