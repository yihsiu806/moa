<div class="relative">
    <div class="md:absolute md:right-10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-2xl font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-amber-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-amber-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:ring-red-100 dark:focus:ring-red-400" onclick="
            this.closest('form').submit();">
                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                Log Out
            </span>
            </button>
        </form>
    </div>

    <h1 class="mr-5 text-grey-dark text-3xl font-bold">Manage Users</h1>

    <div class="mt-10">
        <a href="{{ route('addUser') }}" class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg>
            New
        </a>
    </div>

    <div class="mt-12 mb-10">
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

    <div class="flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">Logs</h1>
        <div class="my-5">
            <a href="#" class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Download</a>
        </div>
    </div>
</div>
<script>
    let users = @js($users);
</script>
<script src="{{ asset('js/admin-dashboard.js') }}" defer></script>
