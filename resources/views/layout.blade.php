<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layout.head')

    <body class="font-sans antialiased">
        @yield('body')
    </body>
</html>
