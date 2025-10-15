@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full bg-light border-secondary-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm text-secondary-800']) }}>
