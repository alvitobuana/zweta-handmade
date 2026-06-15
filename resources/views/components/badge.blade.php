@props(['type' => 'default'])
@php
    $classes = 'badge px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-300';
    if($type === 'ready') $classes = 'badge px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-300';
    if($type === 'pre-order') $classes = 'badge px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-300';
    if($type === 'custom') $classes = 'badge px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-700 border border-pink-300';
@endphp
<span {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</span>
