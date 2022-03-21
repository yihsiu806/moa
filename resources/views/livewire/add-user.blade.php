<div>
    <div class="mb-10">
        <a id="backBtn" href="{{ route('adminDashboard') }}"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>
    <h1 class="mb-5 text-grey-dark text-3xl font-bold">Add User</h1>
    <form id="addNewUserForm" method="POST" action="{{ route('addNewUser') }}">

        <div class="grid grid-cols-1 md:inline-grid md:grid-cols-[1fr_minmax(350px,_2fr)] md:gap-4">

            {{-- Username --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="username">
                Username
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="username" type="text">
                <div class="mb-3 hidden text-sm text-red-500">Username can not be empty.</div>
            </div>

            {{-- Password --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="password">
                Password
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="password" type="password">
                <div class="mb-3 hidden text-sm text-red-500">Password must be at least 6 characters.</div>
            </div>

            {{-- Role --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="inline-full-name">
                Role
            </label>

            {{-- Dropdown --}}
            <div>
                <select id="roleSelect"
                    class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:ring-0
                    focus:border-yellow
                    focus:text-gray-700 focus:bg-white focus:outline-none">
                    <option value="viewer">Viewer</option>
                    <option value="division">Division</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            {{-- Division --}}
            <label class="division-select hidden block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2"
                for="inline-full-name">
                Division
            </label>

            {{-- Dropdown --}}
            <div class="division-select hidden">
                <select id="divisionSelect"
                    class="form-select appearance-none
                    block
                    w-full
                    px-3
                    py-1.5
                    text-base
                    font-normal
                    text-gray-700
                    bg-white bg-clip-padding bg-no-repeat
                    border border-solid border-gray-300
                    rounded
                    transition
                    ease-in-out
                    m-0
                    focus:ring-0
                    focus:border-yellow
                    focus:text-gray-700 focus:bg-white focus:outline-none">
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="mt-6 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Create</button>
        </div>
    </form>
</div>
<script>
    let divisions = @js($divisions);
</script>
<script src="{{ asset('js/add-user.js') }}" defer></script>
