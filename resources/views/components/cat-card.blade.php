<x-card>
    <div class="relative overflow-hidden h-96 sm:h-72">
        <img src="{{ $cat->image_url }}" class="absolute top-0 block w-full min-h-full -translate-x-1/2 left-1/2">
    </div>

    <div class="mt-2">
        <h4 class="text-2xl font-semibold text-center">{{ $cat->name }}</h4>
    </div>

    <div class="flex mt-4">
        <div class="flex flex-col items-center border-r grow">
            <span class="font-semibold">{{ __('Age') }}</span>
            <span class="mt-2">{{ $cat->age }}</span>
        </div>

        <div class="flex flex-col items-center border-r grow">
            <span class="font-semibold">{{ __('Gender') }}</span>
            <span class="mt-2">{{ $cat->gender->label() }}</span>
        </div>

        <div class="flex flex-col items-center grow">
            <span class="font-semibold">{{ __('Breed') }}</span>
            <span class="mt-2">{{ $cat->breed }}</span>
        </div>
    </div>

    <div class="mt-6">
        <x-link-button href="{{ route('user.cats.show', ['cat' => $cat->id]) }}">
            {{ __('Details') }}
        </x-link-button>
    </div>
</x-card>
