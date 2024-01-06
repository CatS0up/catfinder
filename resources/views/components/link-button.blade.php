@props([
    'href' => '#',
])

<a href="{{ $href }}" {{ $attributes->class(['outline-none', 'group']) }}>
    <x-primary-button class="justify-center w-full group-hover:bg-gray-700 dark:group-hover:bg-white group-focus:bg-gray-700 dark:group-focus:bg-white active:group-bg-gray-900 dark:group-active:bg-gray-300 group-focus:outline-none focus:ring-2 group-focus:ring-indigo-500 group-focus:ring-offset-2 dark:group-focus:ring-offset-gray-800">
        {{ $slot }}
    </x-primary-button>
</a>
