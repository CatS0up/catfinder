@extends('layout')

@section('body')

    @include('guest.partials.navigation')

    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20" />
            </a>
        </div>

        <x-card class="w-full mt-6 sm:max-w-md">
            @yield('content')
        </x-card>
    </div>
@endsection
