@props(['active'])

@php
// PERUBAHAN: Kelas diubah total untuk tema gelap
$baseClasses = 'flex items-center p-3 w-full text-sm font-medium rounded-lg transition ease-in-out duration-150';

$inactiveClasses = 'text-gray-300 hover:bg-slate-700 hover:text-white';

$activeClasses = 'bg-slate-900 text-white';

$classes = $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>