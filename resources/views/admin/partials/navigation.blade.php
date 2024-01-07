<x-navbar :logoHref="route('admin.dashboard')">
    <x-slot name="navLinks">
        <x-nav-link :href="route('user.cats.index')">
            {{ __('Home') }}
        </x-nav-link>

        @role('admin')
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        @endrole
    </x-slot>

    <x-slot name="dropdowns">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                    <div>{{ auth()->user()->name }}</div>

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
                <x-dropdown-link-logout />
            </x-slot>
        </x-dropdown>
    </x-slot>

    <x-slot name="responsiveNavigationMenus">
        <x-responsive-menu>
            <x-slot name="navLinks">
                <x-responsive-nav-link :href="route('user.cats.index')">
                    {{ __('Home') }}
                </x-responsive-nav-link>

                @role('admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @endrole
            </x-slot>
        </x-responsive-menu>

        <x-responsive-menu>
            <x-slot name="settingsOptionsHeader">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
            </x-slot>

            <x-slot name="settingsOptions">
                <x-responsive-nav-link-logout />
            </x-slot>
        </x-responsive-menu>
    </x-slot>
</x-navbar>
