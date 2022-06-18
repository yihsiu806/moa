<nav x-data="{ open: false }" class="bg-green border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="">

        <div
            style="height: 96px; display: grid; grid-template-columns: repeat(8, 1fr); grid-template-rows: repeat(96px, auto);">

            <!-- Logo -->
            <div class="flex ml-2" style="height: 96px; grid-column-start: 1; grid-column-end:2;">
                <div class="w-[32px] bg-[#fcb414]"></div>
                <div class="bg-[#f4f4f4] p-2">
                    <a class="h-full flex flex-none items-center" href="{{ route('home') }}">
                        <img class="w-[84px]" src="/images/moa-logo.png" alt="moa-logo">
                    </a>
                </div>
            </div>

            {{-- data share --}}
            <div style="height: 96px; grid-column-start:2; grid-column-end: 4; display: flex; ">

                <span class="ml-3 font-serif text-3xl uppercase tracking-wider text-yellow self-center font-bold">Data
                    share</span>
            </div>

            {{-- data share image --}}
            <div class="" style="grid-column-start:4; grid-column-end: 6; position:relative;">
                <img class="" src="/images/files-logo.png" alt="files-logo"
                    style="width: 230px; position: absolute; top: -12px; left:0; right:0; margin-left:auto; margin-right:auto;">
            </div>

            <!-- Search Box -->
            {{-- <div class="hidden grow md:flex md:justify-center md:items-center">
                <div class="grow max-w-xl relative text-gray-600">
                    <input id="searchInput"
                        class="block w-full bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none focus:ring focus:ring-yellow focus:ring-opacity-40'"
                        type="search" name="search" placeholder="Search">

                    <butaton type="submit" id="searchBtn"
                        class="absolute right-3 top-[3px] bottom-[3px] border bottom-0 text-white bg-white hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-green font-medium rounded-full text-sm px-5 py-2.5 text-center">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                            xml:space="preserve" width="512px" height="512px">
                            <path
                                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </butaton>

                </div>
            </div> --}}

            <!-- Settings Dropdown -->
            <div class="flex-none hidden md:flex md:items-center md:justify-center md:m-1"
                style="grid-column-start:6; grid-column-end: 8; ">
                @if (Auth::check())
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('adminDashboard') }}">
                            <button
                                class="bg-green hover:bg-green-light border border-white rounded text-yellow font-bold py-2 px-4 rounded">
                                {{ Auth::user()->username }}
                            </button>
                        </a>
                    @elseif (Auth::user()->role === 'division')
                        <a href="{{ route('myupload') }}">
                            <button
                                class="bg-green hover:bg-green-light border border-white rounded text-yellow font-bold py-2 px-4 rounded">
                                {{ Auth::user()->username }}
                            </button>
                        </a>
                    @elseif (Auth::user()->role === 'viewer')
                        <a href="{{ route('viewerDashboard') }}">
                            <button
                                class="bg-green hover:bg-green-light border border-white rounded text-yellow font-bold py-2 px-4 rounded">
                                {{ Auth::user()->username }}
                            </button>
                        </a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="bg-green hover:bg-green-light border border-green-light rounded text-white font-bold py-2 px-4 rounded">
                                Log Out
                            </button>
                        </form>
                    @endif
                @else
                    <a href="/login"
                        class="bg-green hover:bg-green-light border border-white rounded text-yellow font-bold py-2 px-8 rounded">
                        Login
                    </a>
                @endif

            </div>
            <div class="w-[18px] bg-[#fcb414] h-full"
                style="grid-column-start:8; grid-column-end: 9; justify-self: end;"></div>

            <!-- Hamburger -->
            <div class="mr-2 flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Search Box -->
            {{-- <div class="px-4 text-yellow-light">
                Search
            </div>
            <div class="px-3">
                <input
                    class="block w-full bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none focus:ring focus:ring-yellow focus:ring-opacity-40 py-2"
                    type="search" name="search" placeholder="Search">

                <button type="submit"
                    class="mt-2 bg-yellow hover:bg-yellow-light text-white font-bold py-2 px-4 rounded-full">
                    Search
                </button>
            </div> --}}
        </div>

        <div class="border-t border-b border-gray-200">

            @if (Auth::check())
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('adminDashboard') }}"
                        class="block pl-3 pr-4 py-3 cursor-pointer border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out font-bold text-xl text-white hover:bg-yellow-light {{ request()->is('admin/dashboard') ? 'bg-yellow' : '' }}">
                        <span
                            class="block md:hidden {{ request()->is('admin/dashboard') ? 'text-green' : 'text-yellow' }}">Dashboard</span>
                        {{ Auth::user()->username }}
                    </a>
                @elseif (Auth::user()->role === 'division')
                    <a href="{{ route('myupload') }}"
                        class="block pl-3 pr-4 py-3 cursor-pointer border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out font-bold text-xl text-white hover:bg-yellow-light {{ request()->is('myupload') ? 'bg-yellow' : '' }}">
                        <span
                            class="block md:hidden {{ request()->is('myupload') ? 'text-green' : 'text-yellow' }}">My
                            Upload</span>
                        {{ Auth::user()->username }}
                    </a>
                @elseif (Auth::user()->role === 'viewer')
                    <a href="{{ route('viewerDashboard') }}"
                        class="block pl-3 pr-4 py-3 cursor-pointer border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out font-bold text-xl text-white hover:bg-yellow-light {{ request()->is('viewerDashboard') ? 'bg-yellow' : '' }}">
                        <span
                            class="block md:hidden {{ request()->is('viewerDashboard') ? 'text-green' : 'text-yellow' }}">Setting</span>
                        {{ Auth::user()->username }}
                    </a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-green hover:bg-green-light border border-green-light rounded text-white font-bold py-2 px-4 rounded">
                            Log Out
                        </button>
                    </form>
                @endif
            @else
                <a href="/login"
                    class="block pl-3 pr-4 py-3 cursor-pointer border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out font-bold text-xl text-white hover:bg-yellow-light">
                    <span class="block md:hidden text-yellow">Login</span>
                </a>
            @endif

        </div>

        <div>
            <livewire:mobile-sidebar />
        </div>
    </div>
</nav>
