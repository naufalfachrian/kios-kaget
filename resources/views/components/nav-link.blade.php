@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-4 border-b-2 border-indigo-400 dark:border-indigo-600 text-lg font-medium leading-5 text-white dark:text-gray-100 hover:text-brand-brown hover:bg-white hover:backdrop-blur transition duration-150 ease-in-out rounded-xl'
            : 'inline-flex items-center p-4 border-b-2 border-transparent text-lg font-medium leading-5 text-white hover:text-gray-700 hover:text-brand-brown hover:bg-white hover:backdrop-blur transition duration-150 ease-in-out rounded-xl';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
