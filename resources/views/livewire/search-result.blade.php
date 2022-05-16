<div class="px-5">
    <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-gray-500">
        <span class="mr-5">Search:</span>
        <span>"{{ $searchQuery }}"</span>
    </h3>
    <h3 class="font-medium leading-tight text-3xl mt-0 mb-2 text-gray-500">
        <span class="mr-5">Result:</span>
        <span id="searchResultCount"></span>
    </h3>
    <div class="mt-10 search-card grid-cols-2 border-2 py-2 px-5">
        <div class="text-base  text-gray-600 font-semibold">Title</div>
        <div class="title"></div>
        <div class="text-base  text-gray-600 font-semibold">Description</div>
        <div class="description"></div>
        <div class="text-base  text-gray-600 font-semibold">Duration</div>
        <div class="duration"></div>
        <div class="text-base  text-gray-600 font-semibold">Download count</div>
        <div class="download-count"></div>
        <div class="text-base  text-gray-600 font-semibold">Content</div>
        <div class="content"></div>
        <div class="text-base  text-gray-600 font-semibold">Division</div>
        <div class="division"></div>
        <div class="text-base  text-gray-600 font-semibold">Updated at</div>
        <div class="updated-at"></div>
        <div class="text-base  text-gray-600 font-semibold">Download</div>
        <div class="download"></div>
    </div>
</div>
<script>
    let searchQuery = @js($searchQuery);
</script>
<script src="{{ asset('js/search-result.js') }}" defer></script>
