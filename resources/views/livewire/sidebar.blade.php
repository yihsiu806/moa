@if (request()->is('division') || request()->is('divisions/*') || request()->is('admin') || request()->is('viewer'))

    <aside class="shrink-0 hidden md:block md:w-[240px] md:bg-[#eee] md:relative md:h-full">

        <div id="sidebar"
            class="md:pt-10 md:pb-[120px] md:absolute md:top-0 md:right-0 md:bottom-0 md:left-0 md:overflow-y-auto">

            <x-sidebar-link class="hidden md:flex" href="/division" :active="request()->is('division') || request()->is('admin') || request()->is('viewer')">
                <x-slot name="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M20 7.093v-5.093h-3v2.093l3 3zm4 5.907l-12-12-12 12h3v10h7v-5h4v5h7v-10h3zm-5 8h-3v-5h-8v5h-3v-10.26l7-6.912 7 6.99v10.182z" />
                    </svg>
                </x-slot>
                Welcome
            </x-sidebar-link>

            @foreach ($divisions as $division)
                <x-sidebar-link :href="'/divisions/' . $division->slug" :active="request()->is('divisions/' . $division->slug)" :data-slug="$division->slug">
                    <x-slot name="icon">
                        @if ($division->icon)
                            {!! $division->icon !!}
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24" zoomAndPan="magnify" viewBox="0 0 375 374.999991" height="24"
                                preserveAspectRatio="xMidYMid meet" version="1.0">
                                <path
                                    d="M 10.71875 346.996094 C 3.695312 349.148438 -0.238281 356.597656 1.914062 363.617188 C 4.070312 370.636719 11.527344 374.546875 18.539062 372.421875 C 70.71875 356.371094 114.960938 346.410156 174.203125 346.410156 C 235.414062 346.410156 303.539062 356.128906 356.460938 372.421875 C 363.511719 374.601562 370.945312 370.597656 373.085938 363.617188 C 375.253906 356.59375 371.304688 349.164062 364.28125 346.996094 C 312.765625 331.144531 247.660156 321.355469 187.5 320.066406 L 187.5 186.730469 C 239.46875 186.238281 291.847656 181.394531 329.136719 149.429688 C 370.265625 114.175781 373.671875 65.226562 373.671875 13.960938 C 373.671875 6.621094 367.710938 0.664062 360.371094 0.664062 C 317.9375 0.664062 258.191406 8.511719 214.585938 45.890625 C 186.25 70.1875 172.792969 101.835938 166.449219 128.179688 C 160.105469 116.769531 151.863281 105.679688 141.171875 95.863281 C 103.269531 61.144531 51.4375 53.855469 14.628906 53.855469 C 7.289062 53.855469 1.328125 59.8125 1.328125 67.152344 C 1.328125 114.28125 4.28125 159.296875 39.839844 191.886719 C 71.886719 221.261719 116.503906 226.050781 160.902344 226.609375 L 160.902344 320.09375 C 104.972656 321.476562 61.277344 331.4375 10.71875 346.996094 Z M 231.886719 66.089844 C 265.09375 37.621094 310.613281 29.109375 346.96875 27.554688 C 346.261719 68.429688 341.210938 104.054688 311.820312 129.242188 C 281.289062 155.425781 234.800781 159.707031 188.070312 160.1875 C 190.066406 136.582031 198.511719 94.707031 231.886719 66.089844 Z M 57.804688 172.273438 C 33.164062 149.695312 28.710938 117.632812 28.03125 80.8125 C 58.402344 82.472656 95.796875 90.371094 123.179688 115.480469 C 151.039062 141.011719 158.445312 178.3125 160.304688 200.054688 C 121.4375 199.507812 83.003906 195.386719 57.804688 172.273438 Z M 57.804688 172.273438 "
                                    fill-opacity="1" fill-rule="nonzero" />
                            </svg>
                        @endif
                    </x-slot>
                    {{ $division->name }}
                </x-sidebar-link>
            @endforeach

            <div class="grid grid-cols-2 gap-y-2 mt-10 pt-10 pl-8 border-t border-gray-300">
                <span class="font-bold text-grey-dark">Files</span>
                <span id="filesCount" class="text-grey-dark">{{ $filesCount }}</span>
                <span class="font-bold text-grey-dark">Storage</span>
                <span id="storageCount" class="text-grey-dark">{{ $sizeCount }}</span>
            </div>
        </div>

    </aside>

    <script src="{{ asset('js/sidebar.js') }}" defer></script>

@endif
