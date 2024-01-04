@extends('admin.layout')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="flex items-center">
         <div class="w-1/4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold">{{ __('Available Cats')  }}</h3>

                <div class="mt-4 text-xl">
                    0
                </div>
            </div>
        </div>

         <div class="w-1/4 ml-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold">{{ __('Adopted Cats') }}</h3>

                <div class="mt-4 text-xl">
                    0
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("You're logged in!") }}
        </div>
    </div>
@endsection
