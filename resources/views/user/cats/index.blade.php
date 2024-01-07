@extends('user.layout')

@section('content')
    <div class="flex items-center justify-end mb-6">
        <x-link-button href="{{ route('user.cats.create') }}" class="ml-auto">{{ __('Add') }}</x-link-button>
    </div>
    @if ($model['cats']->isEmpty())
        <div class="w-full h-full m-auto text-xl font-semibold text-center text-gray-900 dark:text-gray-100">
            {{ __('We do not currently have any cats for adoption') }}</div>
    @else
        <section class="grid items-start row-auto gap-6 auto-rows-min sm:grid-cols-2 lg:grid-cols-3 grow">
            @foreach ($model['cats'] as $cat)
                <x-cat-card :cat="$cat">
                    <x-link-button href="{{ route('user.cats.show', ['cat' => $cat->id]) }}">
                        {{ __('Details') }}
                    </x-link-button>
                </x-cat-card>
            @endforeach
        </section>

        <div class="mt-10">
            {{ $model['cats']->links() }}
        </div>
    @endempty
@endsection
