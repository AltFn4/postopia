@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-onyx-500 dark:text-deep_peach-100']) }}>
    {{ $value ?? $slot }}
</label>
