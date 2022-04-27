<div class="mb-10 flex justify-between">
    {{-- back button --}}
    <div>
        <a id="backBtn" href="{{ url()->previous() }}"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>

    {{-- logout button --}}
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="text-2xl font-medium text-gray-900 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                onclick="this.closest('form').submit();">
                Log Out
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
