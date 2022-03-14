<x-app-layout>
    <div class="py-8">
        @if (request()->is('viewer'))
            <livewire:welcome />
        @else
            <livewire:files />
        @endif
    </div>
</x-app-layout>