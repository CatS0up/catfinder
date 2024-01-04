@extends('admin.layout')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Cat name') }}
    </h2>
@endsection

@section('content')
    <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            {{ __("Show Cat Card") }}
        </div>
    </div>
@endsection
