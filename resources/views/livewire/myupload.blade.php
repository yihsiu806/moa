<div class="px-5 pt-8 md:px-10">
    <x-dashboard-header></x-dashboard-header>

    <div class="mb-5 flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">
            Division</h1>
        <a href="{{ route('goToEditDivision') }}"
            class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Edit
            Division</a>
    </div>

    <div class="flex items-center">

        <img id="divisionPicture" class="mr-5 avatar-icon" src="/images/division-default-picture.png"
            alt="division picture">
        <span id="helloDivision" class="text-gray-600 text-2xl font-semibold "></span>
    </div>

    <h2 class="mt-8 mb-5 text-grey-dark text-2xl font-bold">Officer</h2>
    <div class="flex flex-wrap">
        <div class="mr-5">
            <img id="officerPicture" class="avatar-icon" src="/images/officer-default-picture.png"
                alt="officer picture">
        </div>
        <div class="grid grid-cols-2 gap-y-1 gap-x-2 font-medium">
            <span class="text-gray-500">Name</span>
            <span id="officerName" class="text-gray-600 font-semibold"></span>
            <span class="text-gray-500">Position</span>
            <span id="officerPosition" class="text-gray-600 font-semibold"></span>
            <span class="text-gray-500">Telephone</span>
            <span id="officerTelephone" class="text-gray-600 font-semibold"></span>
            <span class="text-gray-500">Email</span>
            <span id="officerEmail" class="text-gray-600 font-semibold"></span>
        </div>
    </div>

    <div class="mt-16 mb-5 flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">
            My Uploads</h1>
        <div>
            <a href="{{ route('fileUpload') }}"
                class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
                <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z" />
                </svg>
                Upload New File
            </a>
        </div>
    </div>

    <div class="list-table bg-white rounded">
        <table id="filesTable" class="hover row-border" style="width:100%">
            <thead>
                <tr>
                    <th class="all">File</th>
                    <th class="not-mobile">Division</th>
                    <th class="not-mobile">Duration</th>
                    <th class="not-mobile">Last modified</th>
                    <th class="not-mobile">Edit</th>
                    <th class="desktop">Delete</th>
                    <th class="desktop">Download</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <div class="mt-16 mb-5">
        <h1 class="mr-5 mb-8 text-grey-dark text-3xl font-bold">
            Change Password</h1>

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

</div>
<script>
    let files = @js($files);
    let division = @js($division);
    let officer = @js($officer);
</script>
<script src="{{ asset('js/myupload.js') }}" defer></script>
