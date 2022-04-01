<div class="container mx-auto">

    <div class="mb-10">
        <a href="{{ Auth::user()->role == 'admin' ? route('adminDashboard') : route('myupload') }}"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>

    <h1 id="editTitle" class="mb-5 text-grey-dark text-3xl font-bold">Edit Division</h1>

    <form id="modifyDivisionForm" method="POST">
        @method('patch')
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2">
                <h3 class="mb-5 text-grey-dark text-xl font-semibold">Division Picture</h3>
                <div class="flex flex-wrap">
                    <div class="w-full px-2 md:w-1/2">
                        <img id="divisionPicture"
                            class="inline-block overflow-hidden w-[120px] h-[120px] rounded-[50%] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]"
                            src="/images/division-default-picture.png" alt="division picture">
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="editDivisionPicture"
                            class="mt-3 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">Choose
                            photo</label>
                        <input id="editDivisionPicture" accept="image/png, image/jpeg, image/jpg" type="file" hidden>
                        <div id="resetDivisionPicture"
                            class="mt-3 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">
                            Reset photo
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-2 md:w-1/2">
                <h3 class="mt-5 mb-5 text-grey-dark text-xl font-semibold md:mt-0">Division Icon</h3>
                <div class="flex flex-wrap">
                    <div class="w-full px-2 md:w-1/2">
                        <img id="divisionIcon"
                            class="inline-block overflow-hidden w-[100px] h-[100px] rounded-[3px] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]"
                            src="/images/division-default-icon.svg" alt="division picture">
                    </div>
                    <div class="w-full px-2 md:w-1/2">
                        <label for="editDivisionIcon"
                            class="mt-3 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">Choose
                            icon</label>
                        <input id="editDivisionIcon" accept="image/svg+xml" type="file" hidden>
                        <div id="resetDivisionIcon"
                            class="mt-3 inline-block cursor-pointer font-grey bg-white rounded-[6px] border border-[#d0d7de] px-4 py-2">
                            <span class="ml-2">Reset icon</span>
                        </div>
                        <div class="mt-3 text-gray-600">(Please upload svg file, width is 24px and height is 24px, color
                            is #5F6368)</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap mb-5">
            <div class="w-full md:w-1/2 pr-3">
                <h3 class="mb-3 text-grey-dark text-xl font-semibold">Division Name</h3>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="divisionName" type="text">
                <div class="hidden text-sm text-red-500">Division name can not be empty.</div>
            </div>
            <div class="w-full md:w-1/2">
                <h3 class="mb-3 text-grey-dark text-xl font-semibold">Division Slug</h3>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="divisionSlug" type="text">
                <div class="hidden text-sm text-red-500">Division slug can not be empty.</div>
                <span class="text-sm text-gray-700">A short name used in URL.</span>
            </div>
        </div>
        <h1 class="mb-5 text-grey-dark text-3xl font-bold">Edit Officer</h1>
        <div class="mb-5 flex flex-wrap">
            <div class="">
                <img id="officerPicture"
                    class="inline-block overflow-hidden w-[110px] h-[110px] rounded-[35px] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]"
                    src="/images/officer-default-picture.png" alt="officer picture">
            </div>
            <div class="ml-5">
                <label for="editOfficerPicture"
                    class="mt-3 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">Choose
                    photo</label>
                <input id="editOfficerPicture" accept="image/png, image/jpeg, image/jpg" type="file" hidden>
                <div id="resetOfficerPicture"
                    class="mt-3 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">
                    Reset photo
                </div>
            </div>
        </div>
        <div class="flex flex-wrap mb-4">
            <div class="w-full md:w-1/2 pr-3">
                <h3 class="mb-3 text-grey-dark text-xl font-semibold">Name</h3>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerName" type="text">
                <div class="hidden text-sm text-red-500">Officer name can not be empty.</div>
            </div>
            <div class="w-full md:w-1/2">
                <h3 class="mb-3 text-grey-dark text-xl font-semibold">Position</h3>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerPosition" type="text">
                <div class="hidden text-sm text-red-500">Position can not be empty.</div>
            </div>
        </div>
        <div class="flex flex-wrap mb-4">
            <div class="w-full md:w-1/2 pr-3">
                <h3 class="mb-3 text-grey-dark text-xl font-semibold">Telephone</h3>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerTelephone" type="text">
                <div class="hidden text-sm text-red-500">Telephone can not be empty.</div>
            </div>
            <div class="w-full md:w-1/2">
                <h3 class="mb-3 text-grey-dark text-xl font-semibold">Email</h3>
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerEmail" type="text">
                <div class="hidden text-sm text-red-500">Email can not be empty.</div>
            </div>
        </div>
        <button type="submit"
            class="mt-6 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Save</button>
    </form>
</div>
<script>
    let division = @js($division);
    let officer = @js($officer);
</script>
<script src="{{ asset('js/edit-division.js') }}" defer></script>
