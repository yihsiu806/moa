<div class="px-5">
    <div class="mb-10">
        <a href="{{ route('adminDashboard') }}" id="backBtn"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>
    <h1 class="mb-5 text-grey-dark text-3xl font-bold">
        <span style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Edit
            User</span>
    </h1>
    <form id="editUserForm" method="POST">

        <div class="grid grid-cols-1 md:inline-grid md:grid-cols-[1fr_minmax(350px,_2fr)] md:gap-4">

            {{-- Username --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="username">
                Username
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="username" type="text">
                <div class="mb-3 hidden text-sm text-red-500">
                    <div>Username can not be empty.</div>
                    <div>You can only use a-z A-Z 0-9 and underscore.</div>
                </div>
            </div>

            {{-- Role --}}
            <label class="mt-2 block text-gray-500 font-bold md:mt-0 md:text-left mb-1 md:mb-0 pr-2"
                for="inline-full-name">
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
                    <option value="admin">Admin</option>
                    <option value="division">Division</option>
                    <option value="viewer">Viewer</option>
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

        {{-- Save Button --}}
        <div class="mt-6 flex justify-start items-center">
            <button type="submit"
                class="inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Save</button>
            <span id="editUserSavedInfo" class="hidden ml-5 text-lime-600 font-medium italic">Saved!</span>
        </div>
    </form>

    <h1 class="mt-16 mb-5 text-grey-dark text-3xl font-bold">
        <span style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Reset
            Password</span>
    </h1>
    <form id="resetPasswordForm" method="POST">
        <div class="grid grid-cols-1 md:inline-grid md:grid-cols-[1fr_minmax(350px,_2fr)] md:gap-4">

            {{-- Password --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="password">
                Password
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="password" type="password">
                <div class="mb-3 hidden text-sm text-red-500">Password must be at 6 characters.</div>
            </div>

        </div>

        <div class="mt-2">
            <button type="submit"
                class="mt-6 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Reset</button>
        </div>
    </form>

    <h1 class="mt-16 mb-5 text-grey-dark text-3xl font-bold">
        <span style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Delete
            User</span>
    </h1>
    <div class="mt-2">
        <button type="submit" id="deleteUserBtn"
            class="mt-6 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Delete
            User</button>
    </div>
</div>
<script>
    let userId = @js($userId);
    let user = @js($user);
    let divisions = @js($divisions);
</script>
<script src="{{ asset('js/edit-user.js') }}" defer></script>
