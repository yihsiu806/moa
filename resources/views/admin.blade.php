<x-app-layout>
    <div>
        @if (request()->is('/') || request()->is('admin'))
            <livewire:welcome />
        @elseif (request()->is('admin/dashboard'))
            <livewire:admin-dashboard />
        @elseif (request()->is('user/add'))
            <livewire:add-user />
        @elseif (request()->is('user/edit'))
            <livewire:edit-user />
        @elseif (request()->is('search-result/*'))
            <livewire:search-result />
        @else
            <livewire:file-viewer />
        @endif
    </div>
</x-app-layout>
