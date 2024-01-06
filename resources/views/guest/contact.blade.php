@extends('guest.layout')

@section('content')
    <div class="mb-4 text-gray-600 dark:text-gray-400">
        <h1 class="text-4xl text-center">{{ __('Contact') }}</h1>
    </div>

    <form method="POST" action="{{ route('guest.contact.send') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="message" :value="__('Message')" />
            <x-textarea id="message" name="message" class="block w-full mt-1">{{ old('message') }}</x-textarea>

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div>
            <x-recaptcha/>

            <x-input-error :messages="$errors->get('recaptcha')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Send') }}
            </x-primary-button>
        </div>
    </form>
@endsection
