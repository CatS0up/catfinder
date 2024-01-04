<form method="POST" action="{{ route('auth.logout') }}">
@csrf

    <x-responsive-nav-link :href="route('auth.logout')" onclick="event.preventDefault();
                                this.closest('form').submit();">
        {{ __('Log Out') }}
    </x-responsive-nav-link>
</form>
