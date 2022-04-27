<div class="px-5 md:px-10">
    <div class="flex flex-warp">
        <div class="w-full md:w-1/2 flex flex-nowrap items-center">
            <img id="divisionPicture" class="mr-5 w-auto shrink-0 avatar-icon inline-block overflow-hidden bg-white"
                src="/images/division-default-picture.png" alt="Division Picture">
            <div id="divisionName" class="w-auto text-green text-xl font-semibold"></div>
        </div>
        <div class="w-full md:w-1/2 flex flex-nowrap">
            <img id="officerPicture" class="shrink-0 avatar-icon mr-5 inline-block overflow-hidden bg-white"
                src="/images/officer-default-picture.png" alt="officer picture">
            <div class="grid grid-cols-[80px_minmax(100px,_1fr)] gap-x-1 gap-y-0 font-semibold">
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

    <div id="ltPlaceholder" class="rounded"> </div>

    <div id="ltWrapper" class="hidden list-table bg-white rounded">
        <table id="listTable" class="hover row-border" style="width:100%">
            <thead>
                <tr>
                    <th> Filename </th>
                    <th> Division </th>
                    <th> Updated </th>
                    <th> Download </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>

<script>
    let division = @js($division);
    let officer = @js($officer);
    // let files = @js($files);
</script>
<script src="{{ asset('js/file-viewer.js') }}" defer></script>
