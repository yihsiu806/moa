@props(['active'])

@php
$classes = $active ?? false ? 'active sidebar-link border-b border-gray-200 pl-3 pr-4 py-3 cursor-pointer text-base text-gray-800 hover:text-gray-800 hover:bg-yellow-light hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out font-bold text-xl bg-yellow flex md:hover:fill-white md:hover:bg-[rgba(5,131,68,.14)] md:border-none md:px-0 md:py-0 md:bg-[rgba(5,131,68,.14)] md:bg-opacity-70 md:text-green md:rounded-tr-[35px] md:rounded-br-[35px] font-bold transition duration-150 ease-in-out' : 'sidebar-link border-b border-gray-200 text-white pl-3 pr-4 py-3 cursor-pointer text-base text-gray-600 hover:text-gray-800 hover:bg-yellow-light hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out font-bold text-xl text-white flex md:hover:bg-transparent md:border-none md:pl-0 md:py-2 md:text-grey-dark';

$iconwrapper = $active ?? false ? 'md:bg-green md:border-r-8 md:border-yellow' : '';
$svgicon = $active ?? false ? 'fill-white md:fill-yellow' : 'fill-white md:fill-grey-dark';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="mr-2 flex items-center md:px-4 md:py-3 {{ $iconwrapper }}">
        <span class="inline-flex justify-center items-center w-[24px] h-[24px] {{ $svgicon }}">
            {{ $icon }}
        </span>
    </span>

    <span class="font-bold md:my-3">
        {{ $slot }}
    </span>
</a>
