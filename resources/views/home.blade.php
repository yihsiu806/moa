<x-app-layout>
    <div>
        @if (request()->is('/'))
            <livewire:welcome />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
