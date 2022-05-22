<div class="container px-5 md:mx-auto">

    <div class="mb-10">
        <a id="backBtn" href="{{ Auth::user()->role == 'admin' ? route('adminDashboard') : route('myupload') }}"
            class="inline-block px-4 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
            <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
            </svg>
            Back</a>
    </div>

    <h1 id="editTitle" class="mb-5 text-grey-dark text-3xl font-bold">Edit Division</h1>

    <form id="modifyDivisionForm" method="POST">
        @method('patch')

        {{-- division picture --}}
        <div class="flex flex-wrap">
            <h3 class="w-full mb-5 md:mb-0 md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold">
                Division Picture
            </h3>
            <div class="w-full md:w-auto">
                <div class="flex flex-wrap">
                    <div id="divisionPicture" class="w-full md:w-auto md:mr-10">
                        <div class="avatar-icon"></div>
                    </div>
                    <div class="w-full md:w-auto  md:self-center ">
                        <label for="editDivisionPicture"
                            class="mt-3 md:mt-0 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">Choose
                            photo</label>
                        <input id="editDivisionPicture" accept="image/png, image/jpeg, image/jpg" type="file" hidden>
                        <div id="resetDivisionPicture"
                            class="mt-3 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">
                            Reset photo
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- division icon --}}
        <div class="mt-10 flex flex-wrap">
            <h3
                class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold md:mt-0">
                Division
                Icon
            </h3>
            <div class="w-full md:w-auto">
                <div class="flex flex-wrap">
                    <div id="divisionIcon" class="w-full md:w-auto  md:mr-10">
                        <div class="avatar-icon"></div>
                    </div>
                    <div class="w-full md:w-auto md:self-center">
                        <label for="editDivisionIcon"
                            class="mt-3 md:mt-0 inline-block cursor-pointer font-grey bg-white  rounded-[6px] border border-[#d0d7de] px-4 py-2">Choose
                            icon</label>
                        <input id="editDivisionIcon" accept="image/svg+xml" type="file" hidden>
                        <div id="resetDivisionIcon"
                            class="mt-3 inline-block cursor-pointer font-grey bg-white rounded-[6px] border border-[#d0d7de] px-4 py-2">
                            <span class="ml-2">Reset icon</span>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-gray-600">(Please upload svg file, width is 24px and height is 24px, color
                    is #5F6368)</div>
            </div>
        </div>

        {{-- division name --}}
        <div class="mt-10 flex flex-wrap">
            <h3 class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 text-grey-dark text-xl font-semibold">Division Name
            </h3>
            <div class="w-full md:w-1/2">
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-[90%] md:w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="divisionName" type="text">
                <div class="hidden text-sm text-red-500">Division name can not be empty.</div>
            </div>
        </div>

        <h1 id="officerTitle" class="mt-16 mb-5 text-grey-dark text-3xl font-bold">Edit Officer</h1>

        {{-- officer picture --}}
        <div class="mb-5 flex flex-wrap">
            <h3 class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold">
                Officer Picture
            </h3>

            <div class="w-full md:w-auto">
                <div class="flex flex-wrap">
                    <div id="officerPicture" class="w-full md:w-auto md:mr-10">
                        <div class="avatar-icon"></div>
                    </div>
                    <div class="w-full md:w-auto  md:self-center ">
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
            </div>
        </div>

        {{-- officer name --}}
        <div class="mt-10 flex flex-wrap">
            <h3 class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold">Name
            </h3>
            <div class="w-full md:w-1/2">
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-[90%] md:w-full  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerName" type="text">
                <div class="hidden text-sm text-red-500">Officer name can not be empty.</div>
            </div>

        </div>

        {{-- officer position --}}
        <div class="mt-10 flex flex-wrap">
            <h3 class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold">
                Position</h3>
            <div class="w-full md:w-1/2">
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-[90%] md:w-full  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerPosition" type="text">
                <div class="hidden text-sm text-red-500">Position can not be empty.</div>
            </div>
        </div>

        {{-- officer telephone --}}
        <div class="mt-10 flex flex-wrap">
            <h3 class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold">
                Telephone</h3>
            <div class="w-full md:w-1/2">
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-[90%] md:w-full  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerTelephone" type="text">
                <div class="hidden text-sm text-red-500">Telephone can not be empty.</div>
            </div>
        </div>

        {{-- officer email --}}
        <div class="mt-10 flex flex-wrap mb-4">
            <h3 class="mb-5 md:mb-0 w-full md:w-[160px] md:mr-10 self-center text-grey-dark text-xl font-semibold">Email
            </h3>
            <div class="w-full md:w-1/2">
                <input
                    class="bg-white appearance-none border-2 border-gray-200 rounded w-[90%] md:w-full  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-yellow focus:ring-yellow/50"
                    id="officerEmail" type="text">
                <div class="hidden text-sm text-red-500">Email can not be empty.</div>
            </div>
        </div>

        {{-- submit --}}
        <button type="submit"
            class="mt-6 mb-8 inline-block px-7 py-3 bg-green text-white font-medium text-base leading-snug uppercase rounded shadow-md hover:bg-green-light hover:shadow-lg focus:bg-green-light focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-light active:shadow-lg transition duration-150 ease-in-out">Save</button>
    </form>
</div>
<script>
    let division = @js($division);
    let officer = @js($officer);
</script>
<script src="{{ asset('js/edit-division.js') }}" defer></script>
