<x-app-layout>
    <div class="py-8">
        @if (request()->is('division'))
            <livewire:welcome />
        @elseif (request()->is('myupload'))
            <livewire:myupload />
        @elseif (request()->is('modify/division'))
            <livewire:division-modification />
        @elseif (request()->is('upload/file'))
            <livewire:upload-file />
        @else
            <livewire:files />
        @endif
    </div>
</x-app-layout>