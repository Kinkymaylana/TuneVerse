<template>
    <nav class="bg-[#301B54] border-b-4 border-[#F5C92A] px-4 md:px-6 py-3">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 w-full">

            <!-- KIRI: Logo & Text -->
            <div class="flex items-center gap-2 justify-center md:justify-start flex-shrink-0">
                <img src="/image/logo.png" alt="Logo" class="w-8 h-8" />
                <span class="font-sunshiney text-[20px] text-white">Tune Verse</span>
            </div>

            <!-- TENGAH: Home + Search + Plus + Profile -->
            <div class="flex flex-wrap md:flex-nowrap items-center justify-center gap-2 w-full">
                <button
                    class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 transition">
                    <img src="/image/ic_home.png" alt="Home" class="w-4 h-4" />
                </button>

                <div class="flex items-center bg-[#8774B080] px-4 py-1 rounded-full flex-grow min-w-[150px] max-w-md">
                    <img src="/image/ic_search.png" alt="Search" class="w-4 h-4 mr-2" />
                    <input type="text" placeholder="Search"
                        class="bg-transparent text-white text-sm placeholder-white w-full focus:outline-none border-none" />
                </div>

                <button
                    class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 transition">
                    <img src="/image/ic_plus.png" alt="Add" class="w-4 h-4" />
                </button>

                <button
                    class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 transition">
                    <img src="/image/ic_profile.png" alt="Profile" class="w-4 h-4" />
                </button>
            </div>

            <!-- KANAN: Slogan -->
            <span class="text-white text-sm font-inter text-center md:text-right mt-2 md:mt-0">
                ~ Every verse begins with a tune.
            </span>

        </div>
    </nav>
</template>

<style scoped>
input:focus {
    outline: none;
    box-shadow: none;
    border: none;
}
</style>
