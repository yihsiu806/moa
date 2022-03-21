@if (request()->is('division') || request()->is('divisions/*'))

    <aside class="shrink-0 hidden md:block md:w-[240px] md:bg-[#eee] md:relative md:h-full">

        <div id="sidebar"
            class="md:pt-10 md:pb-[120px] md:absolute md:top-0 md:right-0 md:bottom-0 md:left-0 md:overflow-y-auto">

            <x-sidebar-link class="hidden md:flex" href="/division"
                :active="request()->is('division') || request()->is('admin')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M20 7.093v-5.093h-3v2.093l3 3zm4 5.907l-12-12-12 12h3v10h7v-5h4v5h7v-10h3zm-5 8h-3v-5h-8v5h-3v-10.26l7-6.912 7 6.99v10.182z" />
                    </svg>
                </x-slot>
                Welcome
            </x-sidebar-link>

            @foreach ($divisions as $division)
                <x-sidebar-link :href="'/divisions/'.$division->slug"
                    :active="request()->is('divisions/'.$division->slug)" :data-slug="$division->slug">
                    <x-slot name="icon">
                        {!! $division->icon !!}
                    </x-slot>
                    {{ $division->name }}
                </x-sidebar-link>
            @endforeach

        </div>

    </aside>

    <script src="{{ asset('js/sidebar.js') }}" defer></script>

@endif
