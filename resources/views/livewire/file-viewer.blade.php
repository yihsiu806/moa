<div>
    <div class="flex flex-warp">
        <div class="w-full md:w-1/2 flex flex-wrap items-center">
            <div>
                <img id="divisionPicture" class="mb-5 mr-5 inline-block overflow-hidden w-[120px] h-[120px] rounded-[50%] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]" src="/images/division-default-picture.png" alt="division picture">
            </div>
            <div id="divisionName" class="break-all text-green text-xl font-semibold"></div>
        </div>
        <div class="w-full md:w-1/2 flex flex-wrap">
            <div>
                <img id="officerPicture" class="mr-5 inline-block overflow-hidden w-[100px] h-[100px] rounded-[35px] bg-white shadow-[0_0_0_1px_rgba(27,31,36,0.15)]" src="/images/officer-default-picture.png" alt="officer picture">
            </div>
            <div class="grid grid-cols-2 gap-x-1 gap-y-0 font-semibold">
                <span class="text-gray-500">Name</span>
                <span id="officerName" class="text-gray-700 font-medium"></span>
                <span class="text-gray-500">Position</span>
                <span id="officerPosition" class="text-gray-700 font-medium"></span>
                <span class="text-gray-500">Telephone</span>
                <span id="officerTelephone" class="text-gray-700 font-medium"></span>
                <span class="text-gray-500">Email</span>
                <span id="officerEmail" class="text-gray-700 font-medium"></span>
            </div>
        </div>
    </div>
    <h1 class="mt-10 text-grey-dark text-3xl font-bold mb-3">Files</h1>
    <div>
        <table id="filesTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Desctiption</th>
                    <th>Duration</th>
                    <th>Last modified</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
        </table>
    </div>
</div>
<script>
    let division = @js($division);
    let officer = @js($officer);
    let files = @js($files);
</script>
<script src="{{ asset('js/file-viewer.js') }}" defer></script>