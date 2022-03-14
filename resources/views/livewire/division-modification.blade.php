<div>
    <form method="POST" action="{{ route('patchDivision') }}">
        @method('patch')
        <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
            <div class="w-full px-2 md:w-1/2">
                <label class="block mb-1" for="formGridCode_name">First name</label>
                <input class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" id="formGridCode_name"/>
            </div>
            <div class="w-full px-2 md:w-1/2">
                <label class="block mb-1" for="formGridCode_last">Last name</label>
                <input class="w-full h-10 px-3 text-base placeholder-gray-600 border rounded-lg focus:shadow-outline" type="text" id="formGridCode_last"/>
            </div>
        </div>
        <h2 class="text-grey-dark text-2xl font-bold">Officers</h2>
    </form>
</div>
