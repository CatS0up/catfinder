<x-navbar :logoHref="route('guest.welcome')">
    <x-slot name="dropdowns">
        <x-locale-dropdown-switcher/>
    </x-slot>

    <x-slot name="responsiveNavigationMenus">
        <x-responsive-menu>
            <x-slot name="settingsOptionsHeader">
                <div class="flex items-center">
                    <img src="{{ asset('images/locale/pl.png') }}" alt="The icon for the Polish language displays the flag of Poland" class="w-4">
                    <span class="ml-2 text-base font-medium text-gray-800 dark:text-gray-200">{{ __('PL') }}</span>
                </div>
            </x-slot>

            <x-slot name="settingsOptions">
                <x-responsive-nav-link :href="route('user.profile.edit')" class="flex items-center mt-3 space-y-1">
                    <img src="{{ asset('images/locale/pl.png') }}" alt="The icon for the Polish language displays the flag of Poland">
                    <span class="ml-2">{{ __('PL') }}</span>
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.dashboard')" class="flex items-center mt-3 space-y-1">
                    <img src="{{ asset('images/locale/en.png') }}" alt="The icon for the English language displays the flag of United Kingdom">
                    <span class="ml-2">{{ __('EN') }}</span>
                </x-responsive-nav-link>
            </x-slot>
        </x-responsive-menu>
    </x-slot>
</x-navbar>
