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
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">Hello!</h1>
        <div class="my-5">
            <a href="{{ route('modifyDivision') }}" type="button" class="text-gray-800 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-lg px-4 py-2 text-center">
                Edit Division</a>
        </div>
    </div>
    <h2 class="text-grey-dark text-2xl font-bold">Officers</h2>

    <div class="mt-6 mb-4 flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold">My Uploads</h1>
        <div>
            <button id="addNewFile" type="button" class="flex justify-center items-center text-gray-900 bg-gradient-to-r from-teal-200 to-lime-200 hover:bg-gradient-to-l hover:from-teal-200 hover:to-lime-200 focus:ring-4 focus:ring-lime-200 dark:focus:ring-teal-700 font-medium rounded-lg text-xl px-5 py-3 text-center fill-gray-900">
                <span class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z"/></svg>
                </span>
                <span>New</span>
            </button>
        </div>
    </div>
    <h1 class="mb-3 text-grey-dark text-2xl font-bold mb-3">Files</h1>

    <!-- Responsive data table -->
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

<div id="uploadFileModal" class="hidden flex justify-center items-center fixed top-0 right-0 bottom-0 left-0 bg-[rgba(0,0,0,.4)]">
    <button id="cancelFileModal" class="fixed top-[64px] right-[128px] bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow fill-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
    </button>
    <div class="w-[490px] p-10 bg-white">
        <form id="uploadFile" action="/uploadFile">
            <div class="relative py-8 bg-[rgba(156,122,0,.08)] rounded-[18px] border-dashed border-2 border-[#DCAC00] text-center">
                <div>
                    <input name="file" id="FileUpload" type="file"
                        class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                    >
                    <div class="flex justify-center items-center">
                        <svg width="64" height="52" viewBox="0 0 64 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_57_726)">
                            <path d="M42.5784 34.5818L32.0006 26.0728L21.4229 34.5818" stroke="#9C7A00" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M32 26.0728V45.2182" stroke="#9C7A00" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M54.1873 39.666C56.7666 38.5349 58.8041 36.745 59.9783 34.5789C61.1526 32.4128 61.3967 29.9938 60.6721 27.7037C59.9475 25.4136 58.2954 23.3828 55.9768 21.9319C53.6581 20.481 50.8047 19.6925 47.8671 19.6909H44.5351C43.7347 17.2004 42.2428 14.8883 40.1716 12.9283C38.1005 10.9684 35.5039 9.41163 32.5772 8.37514C29.6505 7.33864 26.4697 6.84935 23.2741 6.94407C20.0785 7.03878 16.9511 7.71503 14.1271 8.92197C11.3031 10.1289 8.85604 11.8351 6.96978 13.9124C5.08353 15.9896 3.80721 18.3838 3.23677 20.915C2.66634 23.4461 2.81664 26.0484 3.67637 28.526C4.5361 31.0037 6.08289 33.2924 8.20045 35.22" stroke="#9C7A00" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M42.5784 34.5818L32.0006 26.0728L21.4229 34.5818" stroke="#9C7A00" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_57_726">
                            <rect width="63.4667" height="51.0545" fill="white" transform="translate(0.267578 0.545471)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="mt-2 text-xl font-semibold text-[#9C7A00]">
                        Drag your file here or click in this area.
                    </div>
                    <div class="mt-1 text-xl font-semibold text-[#9C7A00]">
                        (Max One GB)
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-6 mb-6">
                <div class="w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Title
                    </label>
                </div>
                <div class="w-2/3">
                    <input name="title" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow" id="fileTitle" type="text">
                </div>
            </div>
            
            <div class="flex items-center mt-6 mb-6">
                <div class="w-1/3">
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Description
                    </label>
                </div>
                <div class="w-2/3">
                    <textarea name="description" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow" id="fileDescription" rows="5">
                    </textarea>
                </div>
            </div>
    
            
            <!-- Upload button -->
            <div class="text-center">
                <button type="submit" class="mt-6 bg-green hover:bg-green-light text-white font-bold py-2 px-4 rounded">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    let files = @js($files)
    // "posts" will now be a JavaScript array of post data from PHP.
</script>
<script src="{{ asset('js/myupload.js') }}" defer></script>

