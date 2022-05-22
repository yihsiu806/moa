<div class="px-5">

    {{-- <h1 class="mb-5 text-grey-dark text-3xl font-bold">Newest</h1>

    <div id="newestWrapper" class="w-full flex flex-wrap">
        <div class="w-[180px] h-[200px] mt-2 mr-5 p-2 rounded border border-gray-300 bg-white overflow-hidden">
            <div class="h-2/3 skeleton-box"></div>
            <div class="h-1/3 mt-2">
                <span class="inline-block w-full h-4 skeleton-box"></span>
                <span class="inline-block w-full h-4 skeleton-box"></span>
            </div>
        </div>
        <div class="w-[180px] h-[200px] mt-2 mr-5 p-2 rounded border border-gray-300 bg-white overflow-hidden">
            <div class="h-2/3 skeleton-box"></div>
            <div class="h-1/3 mt-2">
                <span class="inline-block w-full h-4 skeleton-box"></span>
                <span class="inline-block w-full h-4 skeleton-box"></span>
            </div>
        </div>
        <div class="w-[180px] h-[200px] mt-2 p-2 rounded border border-gray-300 bg-white overflow-hidden">
            <div class="h-2/3 skeleton-box"></div>
            <div class="h-1/3 mt-2">
                <span class="inline-block w-full h-4 skeleton-box"></span>
                <span class="inline-block w-full h-4 skeleton-box"></span>
            </div>
        </div>
    </div> --}}

    {{-- <h1 class="mt-10 mb-5 text-grey-dark text-3xl font-bold">Most Downloaded</h1>

    <div id="mostDownloadedWrapper" class="w-full flex flex-wrap">
        <div class="w-[180px] h-[200px] mt-2 mr-5 p-2 rounded border border-gray-300 bg-white overflow-hidden">
            <div class="h-2/3 skeleton-box"></div>
            <div class="h-1/3 mt-2">
                <span class="inline-block w-full h-4 skeleton-box"></span>
                <span class="inline-block w-full h-4 skeleton-box"></span>
            </div>
        </div>
        <div class="w-[180px] h-[200px] mt-2 mr-5 p-2 rounded border border-gray-300 bg-white overflow-hidden">
            <div class="h-2/3 skeleton-box"></div>
            <div class="h-1/3 mt-2">
                <span class="inline-block w-full h-4 skeleton-box"></span>
                <span class="inline-block w-full h-4 skeleton-box"></span>
            </div>
        </div>
        <div class="w-[180px] h-[200px] mt-2 p-2 rounded border border-gray-300 bg-white overflow-hidden">
            <div class="h-2/3 skeleton-box"></div>
            <div class="h-1/3 mt-2">
                <span class="inline-block w-full h-4 skeleton-box"></span>
                <span class="inline-block w-full h-4 skeleton-box"></span>
            </div>
        </div>
    </div> --}}

    <h1 class="mb-10 text-grey-dark text-3xl font-bold mb-3">Files</h1>

    <div id="ltPlaceholder" class="rounded"> </div>

    <div class="list-table bg-white rounded">
        <table id="listTable" class="hover row-border" style="width:100%">
            <thead>
                <tr>
                    <th class="all"> Filename </th>
                    <th class="not-mobile"> Division </th>
                    <th class="not-mobile"> Updated </th>
                    <th class="desktop"> Download </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@if (Auth::check())
    <script src="{{ asset('js/welcome.js') }}" defer></script>
@else
    <script src="{{ asset('js/public-welcome.js') }}" defer></script>
@endif
