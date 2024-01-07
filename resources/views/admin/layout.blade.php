@extends('layout')

@section('body')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('admin.partials.navigation')

        <!-- Page Header -->
        @hasSection('header')
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif


        <!-- Page Content -->
        <main class="flex flex-col min-h-screen py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>
@endsection
