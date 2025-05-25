<template>
  <div class="min-h-screen bg-gradient-to-b from-[#FFFFFF] to-[#FFF2CD]">
    <Navbar />

    <!-- Hero Section -->
    <section class="px-4 md:px-16 py-10 md:py-20">
      <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-10">
        <div class="max-w-xl text-center md:text-left">
          <h1 class="text-[40px] font-inter font-semibold text-[#301B54]">
            Step into the Verse — where every tune tells your story.
          </h1>
          <p class="text-[24px] italic font-inter text-[#816EA3] mt-4">
            ...and let the music write the chapters you haven’t said out loud.
          </p>
        </div>
        <img src="/image/hero.png" alt="Hero Image" class="w-[300px] md:w-[400px] lg:w-[480px]" />
      </div>
    </section>

    <!-- Top Picks Section -->
    <section class="px-4 md:px-16 py-10">
      <h2 class="text-[40px] font-sunshiney text-[#301B54]">This Week’s Top Picks</h2>
      <p class="text-[16px] font-inter font-semibold text-[#695191] mt-1">
        What everyone’s vibing to — right now
      </p>
      <div class="mt-6 overflow-x-auto">
        <div class="flex gap-4 w-max">
          <div
            class="bg-white rounded-xl p-2 shadow-md text-center min-w-[140px] cursor-pointer transition-transform hover:scale-105 hover:shadow-lg">
            <img
              src="/image/samplelagu.png"
              alt=""
              class="rounded-md mb-2 w-full h-24 object-cover transition-transform duration-200 hover:scale-105"
            />
            <p class="font-sunshiney text-[24px] text-[#5B518D]">Bruno Mars</p>
            <p class="font-inter font-bold text-[16px] text-[#301B54]">Orange</p>
            <p class="font-inter font-light text-[14px] text-[#301B54]">7!!</p>
          </div>
          
        </div>
      </div>
    </section>

    <!-- Top 10 Artists Section -->
    <section class="px-4 md:px-16 py-10">
      <h2 class="text-[40px] font-sunshiney text-[#373155]">Top 10 Artists</h2>
      <p class="text-[16px] font-inter font-medium text-[#252C83] mt-1">
        Every tune you need. All in one place
      </p>
      <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        <div
          class="bg-white rounded-xl p-2 shadow-md text-center cursor-pointer transition-transform hover:scale-105 hover:shadow-lg">
          <img
            src="/image/sampleartis.png"
            alt=""
            class="rounded-md mb-2 w-full h-32 object-cover transition-transform duration-200 hover:scale-105"
          />
          <p class="font-sunshiney text-[24px] text-[#5B518D]">Bruno Mars</p>
        </div>
        
      </div>
    </section>
  </div>
</template>

<script setup>
  import Navbar from '@/Components/Navbar.vue';
  const props = defineProps({
    topPicks:   Array,
    topArtists: Array
  });
</script>

<style scoped>
/* Tambahan styling sesuai kebutuhan */
</style>
