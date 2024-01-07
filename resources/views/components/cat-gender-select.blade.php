@props([
    'value' => null,
])

<x-select-input {{ $attributes }}>
    <option value="">{{ __('Select') }}</option>
    @foreach (\App\Enums\CatGender::cases() as $gender)
        <option selected="{{ $value === $gender->value }}" value="{{ $gender->value }}">
            {{ $gender->label() }}
        </option>
    @endforeach
</x-select-input>
