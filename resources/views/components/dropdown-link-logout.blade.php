<form method="POST" action="{{ route('auth.logout') }}">
    @csrf

    <x-dropdown-link :href="route('auth.logout')" onclick="event.preventDefault();
                                    this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>
