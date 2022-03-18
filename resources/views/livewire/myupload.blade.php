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

    <div class="mb-10">
        <a href="{{ route('modifyDivision') }}" class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Edit Division</a>
    </div>
    <div class="flex items-center my-5">
        <img id="divisionPicture" class="mr-5 inline-block overflow-hidden w-[100px] h-[100px] rounded-[50%] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]" src="/images/division-default-picture.png" alt="division picture">
        <span id="helloDivision" class="text-green text-3xl font-bold "></span>
    </div>
    

    <h2 class="mt-10 text-grey-dark text-2xl font-bold">Officer</h2>
    <div class="mt-6 flex flex-wrap">
        <div class="mr-5">
            <img id="officerPicture" class="mr-5 inline-block overflow-hidden w-[100px] h-[100px] rounded-[35px] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]" src="/images/officer-default-picture.png" alt="officer picture">
        </div>
        <div class="grid grid-cols-2 gap-y-1 gap-x-2 font-medium">
            <span class="text-gray-500">Name</span>
            <span id="officerName" class="text-gray-700 font-semibold"></span>
            <span class="text-gray-500">Position</span>
            <span id="officerPosition" class="text-gray-700 font-semibold"></span>
            <span class="text-gray-500">Telephone</span>
            <span id="officerTelephone" class="text-gray-700 font-semibold"></span>
            <span class="text-gray-500">Email</span>
            <span id="officerEmail" class="text-gray-700 font-semibold"></span>
        </div>
    </div>

    <div class="mt-16 mb-4 flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">My Uploads</h1>
        <div>
            <a href="{{ route('uploadFile') }}" class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
                <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg>
                New
            </a>
        </div>
    </div>

    <div>
        <table id="filesTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Last modified</th>
                    <th>Edit</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
        </table>
    </div>
</div>
<script>
    let files = @js($files);
    let division = @js($division);
    let officer = @js($officer);
</script>
<script src="{{ asset('js/myupload.js') }}" defer></script>

