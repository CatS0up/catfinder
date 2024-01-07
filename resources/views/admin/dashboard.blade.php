@extends('admin.layout')

@section('header')
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <section class="flex flex-col gap-6 sm:flex-row sm:items-center">
        <x-card class="w-full sm:w-1/2">
            <h3 class="text-lg font-semibold">{{ __('Available Cats') }}</h3>

            <div class="mt-4 text-xl">
                {{ $model['available_cats_amount'] }}
            </div>
        </x-card>

        <x-card class="w-full sm:w-1/2">
            <h3 class="text-lg font-semibold">{{ __('Adopted Cats') }}</h3>

            <div class="mt-4 text-xl">
                {{ $model['adopted_cats_amount'] }}
            </div>
        </x-card>
    </section>

    @if ($model['cats_for_approval']->isEmpty())
        <div class="w-full h-full m-auto text-xl font-semibold text-center text-gray-900 dark:text-gray-100">
            {{ __('We do not currently have any cats for adoption') }}</div>
    @else
        <section class="grid items-start row-auto gap-6 mt-6 auto-rows-min sm:grid-cols-2 lg:grid-cols-3 grow">
            @foreach ($model['cats_for_approval'] as $cat)
                <x-cat-card :cat="$cat">
                    <form method="POST" action="{{ route('admin.cats.approve.approve', ['cat' => $cat->id]) }}"
                        class="mt-4">
                        @method('PATCH')
                        @csrf

                        <x-link-button
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ __('Accept') }}
                        </x-link-button>
                    </form>

                    <form method="POST" action="{{ route('admin.cats.approve.cancel', ['cat' => $cat->id]) }}"
                        class="mt-4">
                        @csrf
                        @method('PATCH')

                        <x-danger-button class="justify-center w-full"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ __('Cancel') }}
                        </x-danger-button>
                    </form>
                </x-cat-card>
            @endforeach
        </section>

        <div class="mt-10">
            {{ $model['cats_for_approval']->links() }}
        </div>
    @endempty
@endsection
