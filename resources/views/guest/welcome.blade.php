@extends('guest.layout')

@section('content')
    <div class="mb-4 text-gray-600 dark:text-gray-400">
        <h1 class="text-4xl text-center">{{ __('Hello!') }}</h1>
    </div>


    <div class="flex flex-col justify-between gap-4 mt-8 sm:flex-row sm:gap-0">
        <x-link-button href="{{ route('auth.login') }}">
            {{ __('Log in') }}
        </x-link-button>

        <x-link-button href="{{ route('auth.register') }}">
            {{ __('Register') }}
        </x-link-button>

        <x-link-button href="{{ route('guest.contact.show') }}" >
            {{ __('Contact') }}
        </x-link-button>
    </div>
@endsection
