<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('user.cats.index') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('user.cats.index') }}" :active="request()->routeIs('user.cats.index')">
                        {{ __('Cats') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.profile.edit')" :active="request()->routeIs('user.profile.edit')">
                        {{ __('Profile') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div class="flex items-center">
                                <img src="{{ asset('images/locale/pl.png') }}" alt="The icon for the Polish language displays the flag of Poland" class="w-4">
                                <span class="ml-2">{{ __('PL') }}</span>
                            </div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-responsive-nav-link :href="route('user.profile.edit')" class="flex items-center">
                            <img src="{{ asset('images/locale/pl.png') }}" alt="The icon for the Polish language displays the flag of Poland">
                            <span class="ml-2">{{ __('PL') }}</span>
                        </x-responsive-nav-link>

                        <x-responsive-nav-link :href="route('admin.dashboard')" class="flex items-center">
                            <img src="{{ asset('images/locale/en.png') }}" alt="The icon for the English language displays the flag of United Kingdom">
                            <span class="ml-2">{{ __('EN') }}</span>
                        </x-responsive-nav-link>
                    </x-slot>
                </x-dropdown>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div>{{ auth()->user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-responsive-nav-link :href="route('user.profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link :href="route('admin.dashboard')">
                            {{ __('Admin Panel') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('auth.logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <x-responsive-nav-link :href="route('user.profile.edit')" class="mt-3 space-y-1">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.dashboard')" class="mt-3 space-y-1">
                {{ __('Admin Panel') }}
            </x-responsive-nav-link>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('auth.logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4 text-base font-medium text-gray-800 dark:text-gray-200">
                <img src="{{ asset('images/locale/pl.png') }}" alt="The icon for the Polish language displays the flag of Poland" class="w-4">
                <span class="ml-2">{{ __('PL') }}</span>
            </div>

            <x-responsive-nav-link :href="route('user.profile.edit')" class="flex items-center mt-3 space-y-1">
                <img src="{{ asset('images/locale/pl.png') }}" alt="The icon for the Polish language displays the flag of Poland">
                <span class="ml-2">{{ __('PL') }}</span>
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('admin.dashboard')" class="flex items-center mt-3 space-y-1">
                <img src="{{ asset('images/locale/en.png') }}" alt="The icon for the English language displays the flag of United Kingdom">
                <span class="ml-2">{{ __('EN') }}</span>
            </x-responsive-nav-link>
        </div>
    </div>
</nav>