<div class="px-5">
    <x-dashboard-header></x-dashboard-header>

    <h1 class="mt-16 mb-8 text-grey-dark text-3xl font-bold">
        <span style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Change
            Password</span>
    </h1>
    <form id="changePasswordForm" method="POST">
        <div class="grid grid-cols-1 md:inline-grid md:grid-cols-[1fr_minmax(350px,_2fr)] md:gap-4">

            {{-- Current Password --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="password">
                Current Password
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="currentPassword" type="password">
                <div class="mb-3 hidden text-sm text-red-500">Password must be at least 6 characters.</div>
            </div>

            {{-- New Password --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="password">
                New Password
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="newPassword" type="password">
                <div class="mb-3 hidden text-sm text-red-500">Password must be at least 6 characters.</div>
            </div>

            {{-- Confirm New Password --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="password">
                Confirm New Password
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="confirmNewPassword" type="password">
                <div class="mb-3 hidden text-sm text-red-500">Password must be at least 6 characters.</div>
            </div>

        </div>

        <div class="mt-5">
            <button type="submit"
                class="mt-6 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Change</button>
        </div>
    </form>

</div>

<script src="{{ asset('js/viewer-dashboard.js') }}" defer></script>
