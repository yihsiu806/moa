<div class="container mx-auto mb-10">

    <div class="mb-10">
        <a id="goBack" href="{{ route('myupload') }}"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>

    <h1 class="mb-5 text-grey-dark text-3xl font-bold">New File</h1>

    <form id="uploadFileForm" method="POST" action="{{ route('newFile') }}">

        <div class="grid grid-cols-1 md:inline-grid md:grid-cols-[1fr_minmax(350px,_2fr)] md:gap-4">
            <div class="md:col-span-2 mb-2">
                <div id="selectFileAreaWrapper"
                    class="relative py-8 bg-white rounded-[7px] border-4 border-[#eee] text-center hover:border-yellow">

                    {{-- progress bar --}}
                    <div id="progressBarWrapper"
                        class="hidden pt-20 px-5 absolute top-0 right-0 bottom-0 left-0 bg-white">
                        <div class="flex justify-between mb-1">
                            <span class="text-base font-medium text-green ">Processing</span>
                            <span id="progressNumber" class="text-sm font-medium text-green dark:text-white">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div id="progressRect" class="bg-green h-2.5 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>


                    <div id="selectFileModeOn">
                        <input name="file" id="selectFileArea" type="file"
                            class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0">
                        <div class="flex justify-center items-center fill-[#5f6982]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24">
                                <path
                                    d="M16 16h-3v5h-2v-5h-3l4-4 4 4zm3.479-5.908c-.212-3.951-3.473-7.092-7.479-7.092s-7.267 3.141-7.479 7.092c-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h3.5v-2h-3.5c-1.93 0-3.5-1.57-3.5-3.5 0-2.797 2.479-3.833 4.433-3.72-.167-4.218 2.208-6.78 5.567-6.78 3.453 0 5.891 2.797 5.567 6.78 1.745-.046 4.433.751 4.433 3.72 0 1.93-1.57 3.5-3.5 3.5h-3.5v2h3.5c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408z" />
                            </svg>
                        </div>
                        <div id="selectFileAreaError" class="my-5 text-xl font-semibold text-[#5f6982]">
                            Select a file or drag here
                        </div>
                        <button type="button"
                            class=" cursor-pointer inline-block px-6 py-3 bg-yellow text-white font-medium text-base leading-tight rounded shadow-md hover:bg-yellow-light hover:shadow-lg focus:bg-yellow-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-amber active:shadow-lg transition duration-150 ease-in-out">Select
                            a file</button>
                        <div class="mt-5 text-sm font-medium text-[#5f6982]">
                            (Max 1 GB)
                        </div>
                    </div>
                    <div id="selectFileModeOff" class="hidden">
                        <div id="selectFileModeOffFileName" class="my-5 text-xl font-semibold text-[#5f6982]"></div>
                        <button id="selectFileModeOffRemoveBtn" type="button"
                            class="cursor-pointer inline-block px-6 py-3 bg-white text-gray-700 font-medium text-base leading-tight rounded shadow-md hover:bg-gray-200 hover:shadow-lg focus:bg-gray-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-100 active:shadow-lg transition duration-150 ease-in-out">Remove</button>
                    </div>
                </div>
            </div>

            {{-- title --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="fileTitle">
                Title
            </label>
            <div>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="fileTitle" type="text">
                <div class="mb-3 hidden text-sm text-red-500">Title can not be empty.</div>
            </div>

            {{-- description --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2">
                Description
            </label>
            <div>
                <textarea class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="fileDescription" rows="5"></textarea>
                <div class="mb-3 hidden text-sm text-red-500">Description can not be empty.</div>
            </div>

            {{-- duration --}}
            <label class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-2" for="inline-full-name">
                Duration
            </label>
            <div class="md:flex md:items-center">
                <div>
                    <input id="durationFrom" name="start" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow focus:border-yellow block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow dark:focus:border-yellow"
                        placeholder="Select date start">
                    <div class="mb-3 hidden text-sm text-red-500">Please select duration start from when.</div>
                </div>
                <span class="mx-4 text-gray-500">to</span>
                <div>
                    <input id="durationTo" name="end" type="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-yellow focus:border-yellow block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-yellow dark:focus:border-yellow"
                        placeholder="Select date end">
                    <div class="mb-3 hidden text-sm text-red-500">Please select duration end date.</div>
                </div>
            </div>

        </div>

        <div>
            <button type="submit"
                class="mt-10 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Save</button>
        </div>
    </form>
</div>

<script src="{{ asset('js/file-upload.js') }}" defer></script>
