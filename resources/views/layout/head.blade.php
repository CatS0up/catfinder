<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layout.head.links')

    <!-- Styles -->
    @include('layout.head.css')
    @stack('styles')

    <!-- Scripts -->
    @include('layout.head.js')
    @stack('scripts')
</head>
