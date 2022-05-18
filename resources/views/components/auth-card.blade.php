<div class="px-5 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    {{-- <div style="border: 5px solid #056839;" class="relative w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"> --}}
    <div style="border: 3px solid #056839;" class="pb-16 w-full sm:max-w-md mt-6 bg-white shadow-md overflow-hidden">
        {{ $slot }}
    </div>
</div>
