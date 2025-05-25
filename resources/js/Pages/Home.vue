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


    <!-- Explore Musics -->
    <section class="px-4 md:px-16 py-10 relative overflow-hidden">
      <h2 class="text-[40px] font-sunshiney text-[#301B54]">Explore Musics</h2>
      <div class="flex justify-between items-center flex-wrap gap-2 mt-1">
        <p class="text-[16px] font-inter font-semibold text-[#695191]">
          What everyone’s vibing to — right now
        </p>
        <button
          class="text-sm font-inter font-semibold text-[#301B54] hover:underline"
          @click="$inertia.visit('/explore')"
        >
          Lihat Semua
        </button>
      </div>

      <div class="mt-6 relative">
        <div
          ref="carousel"
          class="scrolling-wrapper flex gap-6 overflow-x-auto no-scrollbar px-1 py-2"
        >
          <Link
            v-for="music in topPicks"
            :key="music.id + '-' + music.dup"
            :href="`/music/${music.id}`"
            class="bg-white rounded-[16px] p-3 shadow-lg text-center w-[150px] shrink-0 cursor-pointer transition-transform hover:scale-105 hover:shadow-2xl"
          >
            <img
              :src="music.imageUrl"
              alt="cover"
              class="rounded-[12px] mb-2 w-full h-[150px] object-cover transition-transform duration-200 hover:scale-105"
            />
            <p class="font-inter font-bold text-[16px] text-[#301B54] truncate">{{ music.title }}</p>
            <p class="font-inter font-light text-[14px] text-[#301B54] truncate">{{ music.artist }}</p>
          </Link>
        </div>

        <!-- LEFT BLUR -->
        <div
          class="absolute top-0 left-0 h-full w-24 z-10 bg-gradient-to-r from-[#FFF2CD] to-transparent pointer-events-none"
        ></div>
        <!-- RIGHT BLUR -->
        <div
          class="absolute top-0 right-0 h-full w-24 z-10 bg-gradient-to-l from-[#FFF2CD] to-transparent pointer-events-none"
        ></div>
      </div>
    </section>


    <!-- Top 10 Artists Section -->
    <section class="px-4 md:px-16 py-10">
      <h2 class="text-[40px] font-sunshiney text-[#373155]">Top 10 Artists</h2>
      <p class="text-[16px] font-inter font-medium text-[#252C83] mt-1">Every tune you need. All in one place</p>

      <div class="mt-6 grid grid-cols-5 gap-6">
        <div
          v-for="artist in topArtists"
          :key="artist.name"
          class="bg-white p-3 shadow-md text-center cursor-pointer transition-transform hover:scale-105 hover:shadow-lg">
          <div class="overflow-hidden rounded-[16px]">
            <img
              :src="artist.imageUrl"
              alt="artis"
              class="w-full h-full object-cover" />
          </div>
          <p class="font-sunshiney text-[18px] text-[#5B518D] truncate mt-2">{{ artist.name }}</p>
        </div>
      </div>

    </section>

  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { ref, onMounted } from 'vue';
import Navbar from '@/Components/Navbar.vue';

const topPicks = ref([]);
const topArtists = ref([]);
const carousel = ref(null);

onMounted(async () => {
  try {
    const [musicRes, artistRes] = await Promise.all([
      fetch('http://localhost:3000/api/music/explore'),
      fetch('http://localhost:3000/api/music/top-artists')
    ]);
    const musicData = await musicRes.json();
    topPicks.value = [
      ...musicData.map(m => ({ ...m, dup: 'a' })),
      ...musicData.map(m => ({ ...m, dup: 'b' })),
      ...musicData.map(m => ({ ...m, dup: 'c' }))
    ];
    topArtists.value = await artistRes.json();

    const el = carousel.value;
    const originalWidth = el.scrollWidth / 3;
    const speed = 1;

    function autoScroll() {
      el.scrollLeft += speed;
      if (el.scrollLeft >= originalWidth) {
        el.scrollLeft -= originalWidth;
      }
      requestAnimationFrame(autoScroll);
    }

    autoScroll();
  } catch (err) {
    console.error('Gagal ambil data:', err);
  }
});
</script>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
.scrolling-wrapper {
  scroll-behavior: auto;
  scroll-snap-type: none;
  min-height: 200px;
}
</style>