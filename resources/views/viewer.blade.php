<x-app-layout>
    <div class="py-8">
        @if (request()->is('/') || request()->is('viewer'))
            <livewire:welcome />
        @elseif (request()->is('viewer/dashboard'))
            <livewire:viewer-dashboard />
        @elseif (request()->is('search-result/*'))
            <livewire:search-result />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
