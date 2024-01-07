@extends('user.layout')

@section('content')
    <x-card class="flex flex-col md:flex-row">
        <div class="relative w-full overflow-hidden rounded h-96 sm:w-1/2 md:2/3 lg:w-1/3">
            <img src="{{ $model['cat']->image_url }}"
                class="absolute top-0 block w-full min-h-full -translate-x-1/2 left-1/2">
        </div>

        <section class="flex flex-col gap-4 mt-4 sm:ml-4 sm:mt-0 grow">
            <div class="flex items-center justify-between">
                <span class="font-semibold">{{ __('Cat name') }}</span>
                <span>{{ $model['cat']->name }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span>{{ __('Age') }}</span>
                <span>{{ $model['cat']->age }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="flex items-center justify-between font-semibold">{{ __('Breed') }}</span>
                <span>{{ $model['cat']->breed }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="flex items-center justify-between font-semibold">{{ __('Gender') }}</span>
                <span>{{ $model['cat']->gender->label() }}</span>
            </div>

            <div class="mt-auto">
                @can('update-cat', $model['cat'])
                    <x-link-button href="{{ route('user.cats.edit', ['cat' => $model['cat']->id]) }}">
                        {{ __('Edit') }}
                    </x-link-button>
                @endcan


                @can('choose-cat-for-adoption')
                    <form method="POST" action="{{ route('user.cats.chooseForAdoption', ['cat' => $model['cat']->id]) }}"
                        class="mt-4">
                        @method('PATCH')
                        @csrf

                        <x-link-button
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ __('Choose for adoption') }}
                        </x-link-button>
                    </form>
                @endcan

                @can('delete-cat', $model['cat'])
                    <form method="POST" action="{{ route('user.cats.destroy', ['cat' => $model['cat']->id]) }}"
                        class="mt-4">
                        @csrf
                        @method('DELETE')

                        <x-danger-button class="justify-center w-full"
                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </form>
                @endcan
            </div>
        </section>
    </x-card>

    <x-card class="mt-6">
        <h4 class="text-lg font-semibold">{{ __('Description') }}</h4>

        <div class="mt-4">
            {!! $model['cat']->description !!}
        </div>
    </x-card>
@endsection
