@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full text-left p-3 rounded-lg font-semibold text-white bg-primary-600 focus:outline-none transition-colors duration-150 ease-in-out'
            : 'flex items-center w-full text-left p-3 rounded-lg font-medium text-secondary-300 hover:text-light hover:bg-secondary-800 focus:outline-none focus:bg-secondary-800 transition-colors duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
