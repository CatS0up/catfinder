@extends('layout')

@section('body')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('user.partials.navigation')


    <!-- Page Content -->
    <main>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </div>
    </main>
</div>
@endsection
