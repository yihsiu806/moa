@foreach ($divisions as $division)
    <x-sidebar-link :href="'/divisions/'.$division->slug" :active="request()->is('divisions/'.$division->slug)">
        <x-slot name="icon">
            {!! $division->icon !!}
        </x-slot>
        {{ $division->name }}
    </x-sidebar-link>
@endforeach
