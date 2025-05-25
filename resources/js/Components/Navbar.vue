<template>
    <nav class="bg-[#301B54] border-b-4 border-[#F5C92A] px-4 py-3">
        <div class="flex flex-wrap md:flex-nowrap items-center justify-between gap-3 w-full">
            <!-- Logo & Title -->
            <div class="flex items-center gap-2 w-full md:w-auto justify-center md:justify-start">
                <img src="/image/logo.png" alt="Logo" class="w-8 h-8" />
                <span class="font-sunshiney text-[30px] text-white">Tune Verse</span>
            </div>

            <!-- Icon buttons + Search -->
            <div class="flex items-center gap-3 flex-wrap justify-center w-full md:w-auto">
                <button
                    class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 cursor-pointer transition">
                    <img src="/image/ic_home.png" alt="Home" class="w-4 h-4" />
                </button>

                <button
                    class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 cursor-pointer transition">
                    <img src="/image/ic_plus.png" alt="Add" class="w-4 h-4" />
                </button>

                <div class="rounded-full bg-[#DBDDF580] px-4 py-1 flex items-center gap-2">
                    <img src="/image/ic_search.png" alt="Search" class="w-4 h-4" />
                    <input type="text" placeholder="Search"
                        class="bg-transparent text-white text-sm placeholder-white focus:outline-none focus:ring-0 border-none" />
                </div>
            </div>

            <span class="font-inter text-[16px] text-white text-center w-full md:w-auto">
                ~ Every verse begins with a tune.
            </span>
        </div>
    </nav>
</template>


<script setup>

</script>

<style scoped></style>
