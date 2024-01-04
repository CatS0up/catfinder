<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    @isset ($navLinks)
        <div class="pt-2 pb-3 space-y-1">
            {{ $navLinks }}
        </div>
    @endisset

    @isset($settingsOptionsHeader, $settingsOptions)
    <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                {{ $settingsOptionsHeader }}
            </div>

            <div class="mt-3 space-y-1">
                {{ $settingsOptions }}
            </div>
        </div>
    @endisset
</div>
