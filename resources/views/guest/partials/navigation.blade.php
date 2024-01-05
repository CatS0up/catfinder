<x-navbar :logoHref="route('guest.welcome')">
    <x-slot name="dropdowns">
        <x-locale-dropdown-switcher/>
    </x-slot>

    <x-slot name="responsiveNavigationMenus">
        <x-responsive-locale-switcher/>
    </x-slot>
</x-navbar>
