<x-app-layout>
    <div>
        @if (request()->is('division'))
            <livewire:welcome />
        @elseif (request()->is('myupload'))
            <livewire:myupload />
        @elseif (request()->is('modify/division'))
            <livewire:edit-division />
        @elseif (request()->is('file-upload'))
            <livewire:file-upload />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
