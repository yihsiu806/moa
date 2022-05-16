<x-app-layout>
    <div>
        @if (request()->is('/') || request()->is('division'))
            <livewire:welcome />
        @elseif (request()->is('myupload'))
            <livewire:myupload />
        @elseif (request()->is('division/edit'))
            <livewire:edit-division />
        @elseif (request()->is('file-upload'))
            <livewire:file-upload />
        @elseif (request()->is('file-edit/*'))
            <livewire:file-edit />
        @elseif (request()->is('search-result/*'))
            <livewire:search-result />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
