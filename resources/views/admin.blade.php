<x-app-layout>
    <div>
        @if (request()->is('admin'))
            <livewire:welcome />
        @elseif (request()->is('admin/dashboard'))
            <livewire:admin-dashboard />
        @elseif (request()->is('user/add'))
            <livewire:add-user />
        @elseif (request()->is('user/edit'))
            <livewire:edit-user />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
