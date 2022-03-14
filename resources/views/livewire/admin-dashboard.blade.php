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

    <div class="flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">Manage Users</h1>
        <div>
            <a class="cursor-pointer flex justify-center items-center text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-xl px-5 py-3 text-center fill-gray-900">
                <span class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg>
                </span>
                <span>New</span>
            </a>
        </div>
    </div>

    <div class="flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">Logs</h1>
        <div class="my-5">
            <a href="#" type="button" class="text-gray-800 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-lg px-4 py-2 text-center">
                Download</a>
        </div>
    </div>
</div>
