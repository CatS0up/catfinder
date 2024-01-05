<x-responsive-menu>
    <x-slot name="settingsOptionsHeader">
        <div class="flex items-center">
            <img src="{{ asset("images/locale/{$currentLocaleCode}.png") }}"
                alt="{{ __(':country flag', ['country' => $currentLocaleCode]) }}" class="w-4">
            <span class="ml-2 text-base font-medium text-gray-800 dark:text-gray-200">{{ __($currentLocaleName) }}</span>
        </div>
    </x-slot>

    <x-slot name="settingsOptions">
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
</x-responsive-menu>
