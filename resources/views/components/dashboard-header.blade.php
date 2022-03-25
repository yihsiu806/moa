<div class="mb-10 flex justify-between">
    <div>
        <a id="backBtn" href="{{ url()->previous() }}"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>
    <div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-2xl font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-amber-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-amber-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:ring-red-100 dark:focus:ring-red-400"
                onclick="this.closest('form').submit();">
                <span
                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                    Log Out
                </span>
            </button>
        </form>
    </div>
</div>
<script>
    let sidebarPath = sessionStorage.getItem('currentSidebarPath');
    if (sessionStorage.getItem('currentSidebarPath')) {
        document.getElementById('backBtn').href = sidebarPath;
    }
</script>
