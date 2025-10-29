@props(['value'])

{{-- PERBAIKAN: Menggunakan warna gray standar --}}
<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>