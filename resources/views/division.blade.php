<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        @if (request()->is('division'))
            <livewire:welcome />
        @elseif (request()->is('myupload'))
            <livewire:myupload />
        @else
            <livewire:files />
        @endif
    </div>
</x-app-layout>