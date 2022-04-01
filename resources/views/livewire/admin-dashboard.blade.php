<div>
    <x-dashboard-header></x-dashboard-header>

    <h1 class="text-grey-dark text-3xl font-bold">
        <span style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Manage
            Users</span>
    </h1>

    <div class="mt-10">
        <a href="{{ route('addUser') }}"
            class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z" />
            </svg>
            New
        </a>
    </div>

    <div class="mt-12">
        <table id="usersTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Username</th>
                    <th>Division</th>
                    <th>Last modified</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
        </table>
    </div>

    <h1 class="mt-10 text-grey-dark text-3xl font-bold">
        <span style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Manage
            Divisions</span>
    </h1>

    <div class="mt-10">
        <a href="{{ route('adminAddDivision') }}"
            class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z" />
            </svg>
            New
        </a>
    </div>

    <div class="mt-12 mb-10">
        <table id="divisionsTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Division</th>
                    <th>Officer</th>
                    <th>Last modified</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
        </table>
    </div>

    <div class="flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">
            <span
                style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">Logs</span>
        </h1>
        <div class="my-5">
            <a href="#"
                class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Download</a>
        </div>
    </div>
</div>
<script>
    let users = @js($users);
    let divisions = @js($divisions);
</script>
<script src="{{ asset('js/admin-dashboard.js') }}" defer></script>
