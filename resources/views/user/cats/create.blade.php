@extends('user.layout')

@section('content')
    <x-card>
        <header>
            <h2 class="text-lg font-medium">
                {{ __('Add cat') }}
            </h2>
        </header>

        <section class="mt-6">
            <form method="POST" action="{{ route('user.cats.store') }}">
                @csrf

                <div>
                    <x-input-label for="imageUrl" :value="__('Image url')" />
                    <x-text-input id="imageUrl" class="block w-full mt-1" type="text" name="image_url" :value="old('image_url')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="name" :value="__('Cat name')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="age" :value="__('Age')" />
                    <x-text-input id="age" class="block w-full mt-1" type="number" name="age" :value="old('age')"
                        required autofocus min="1" />
                    <x-input-error :messages="$errors->get('age')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="gender" :value="__('Gender')" />
                    <x-cat-gender-select selectedValue="{{ old('gender') }}" id="gender" name="gender" class="w-full" />
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="breed" :value="__('Breed')" />
                    <x-text-input id="breed" class="block w-full mt-1" type="text" name="breed" :value="old('breed')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('breed')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-ckeditor5 id="description" name="description" />

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        {{ __('Send') }}
                    </x-primary-button>
                </div>
            </form>
        </section>
    </x-card>
@endsection
