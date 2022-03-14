<x-app-layout>
    <div class="py-8">
        @if (request()->is('admin'))
            <livewire:welcome />
        @elseif (request()->is('admin/dashboard'))
            <livewire:admin-dashboard />
        @else
            <livewire:files />
        @endif
    </div>
</x-app-layout>