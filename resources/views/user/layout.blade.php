@extends('layout')

@section('body')
    <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('user.partials.navigation')

        <!-- Page Content -->
        <main class="flex flex-col w-full py-12 mx-auto grow max-w-7xl sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
@endsection
