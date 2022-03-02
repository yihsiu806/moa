<a {{ $attributes->merge(['class' => 'flex p-5 text-grey-dark',], ) }}>
    <span class="mr-5 flex items-center fill-grey-dark">
        {{ $icon }}
    </span>

    <span class="font-bold">
        {{ $slot }}
    </span>
</a>