<div>
    <x-dashboard-header></x-dashboard-header>

    <div class="mb-5 flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold"
            style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(245,167,158,.35) 0);background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">
            Division</h1>
        <a href="{{ route('goToEditDivision') }}"
            class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out">Edit
            Division</a>
    </div>

    <div class="flex items-center">

        <img id="divisionPicture" class="mr-5 avatar-icon" src="/images/division-default-picture.png"
            alt="division picture">
        <span id="helloDivision" class="text-gray-600 text-2xl font-semibold "></span>
    </div>

    <h2 class="mt-8 mb-5 text-grey-dark text-2xl font-bold">Officer</h2>
    <div class="flex flex-wrap">
        <div class="mr-5">
            <img id="officerPicture" class="avatar-icon" src="/images/officer-default-picture.png"
                alt="officer picture">
        </div>
        <div class="grid grid-cols-2 gap-y-1 gap-x-2 font-medium">
            <span class="text-gray-500">Name</span>
            <span id="officerName" class="text-gray-600 font-semibold"></span>
            <span class="text-gray-500">Position</span>
            <span id="officerPosition" class="text-gray-600 font-semibold"></span>
            <span class="text-gray-500">Telephone</span>
            <span id="officerTelephone" class="text-gray-600 font-semibold"></span>
            <span class="text-gray-500">Email</span>
            <span id="officerEmail" class="text-gray-600 font-semibold"></span>
        </div>
    </div>

    <div class="mt-16 mb-5 flex items-center">
        <h1 class="mr-5 text-grey-dark text-3xl font-bold"
            style="background-image: linear-gradient( 180deg ,transparent 60%,rgba(253, 180, 21, 0.35) 0);">
            My Uploads</h1>
        <div>
            <a href="{{ route('fileUpload') }}"
                class="inline-block px-6 py-2 border-2 border-green-light text-green-light font-medium text-base leading-tight uppercase rounded hover:bg-white hover:text-yellow hover:border-yellow focus:outline-none focus:ring-0 transition duration-150 ease-in-out inline-flex justify-center items-center fill-green hover:fill-yellow">
                <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M24 9h-9v-9h-6v9h-9v6h9v9h6v-9h9z" />
                </svg>
                New
            </a>
        </div>
    </div>

    <div class="list-table bg-white rounded">
        <table id="filesTable" class="hover row-border" style="width:100%">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Division</th>
                    <th>Duration</th>
                    <th>Last modified</th>
                    <th>Edit</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>
<script>
    let files = @js($files);
    let division = @js($division);
    let officer = @js($officer);
</script>
<script src="{{ asset('js/myupload.js') }}" defer></script>
