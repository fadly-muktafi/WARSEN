@props(['disabled' => false])

{{-- MENGEMBALIKAN GAYA INPUT KE STANDAR YANG BERSIH DAN SESUAI GAMBAR --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 w-full']) !!}>