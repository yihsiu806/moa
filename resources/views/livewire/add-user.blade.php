<div>
    <div class="mb-6">
        <a href="{{ route('adminDashboard') }}" class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>
            Back</a>
    </div>
    <h1 class="mb-5 text-grey-dark text-3xl font-bold">Add User</h1>
    <form id="addNewUserForm" method="POST" action="{{ route('addNewUser') }}">

        <div class="grid grid-cols-1 md:inline-grid md:grid-cols-[1fr_minmax(350px,_2fr)] md:gap-4">
            
            {{-- Username --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="fileTitle">
                Username
            </label>
            <div>
                <input class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50" id="username" type="text">
                <div class="mb-3 hidden text-sm text-red-500">Username can not be empty.</div>
            </div>

            {{-- Password --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2">
                Password
            </label>
            <div>
                <input class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50" id="password" type="password">
                <div class="mb-3 hidden text-sm text-red-500">Password can not be empty.</div>
            </div>

            {{-- Role --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="inline-full-name">
                Role
            </label>
            {{-- Dropdown --}}
            <div>
                <div>
                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                        Role
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                      <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                      <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                      <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-1">Support</a>
                      <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>
                      
                    </div>
                  </div>
            </div>
        </div>

        <button type="submit" class="mt-6 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Create</button>
    </form>
</div>
