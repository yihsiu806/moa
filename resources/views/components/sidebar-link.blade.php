@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex px-5 py-3 bg-[rgba(5,131,68,.14)] bg-opacity-70 text-green rounded-tr-[35px] rounded-br-[35px] font-bold transition duration-150 ease-in-out'
            : 'flex p-5 text-grey-dark';
$svgicon = ($active ?? false)
            ? 'fill-green'
            : 'fill-grey-dark'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="mr-5 flex items-center {{ $svgicon }}">
        {{ $icon }}
    </span>

    <span class="font-bold">
        {{ $slot }}
    </span>
</a>