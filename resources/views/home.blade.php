<x-app-layout>
    <div>
        @if (request()->is('/'))
            <livewire:welcome />
        @elseif (request()->is('search-result/*'))
            <livewire:search-result />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
