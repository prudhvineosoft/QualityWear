@props(['value'])

<label {{ $attributes->merge(['class' => 'text-dark']) }}>
    {{ $value ?? $slot }}
</label>