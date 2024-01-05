<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button
            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
            <div class="flex items-center">
                <img src="{{ asset("images/locale/{$currentLocaleCode}.png") }}"
                    alt="{{ __(':country flag', ['county' => $currentLocaleCode]) }}" class="w-4">
                <span class="ml-2">{{ __($currentLocaleName) }}</span>
            </div>

            <div class="ms-1">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        @foreach ($availableLocales as $name => $code )
            <form method="POST" action="{{ route('shared.locale.switch', ['locale' => $code]) }}">
                @csrf

                <x-responsive-nav-link href="#" class="flex items-center" onclick="event.preventDefault(); this.closest('form').submit();">
                    <img src="{{ asset("images/locale/{$code}.png") }}"
                        alt="{{ __(':country flag', ['country' => $code]) }}">
                    <span class="ml-2">{{ __($name) }}</span>
                </x-responsive-nav-link>
            </form>
            @endforeach
    </x-slot>
</x-dropdown>
