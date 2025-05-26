<template>
  <nav class="bg-[#301B54] border-b-4 border-[#F5C92A] px-4 md:px-6 py-3">
    <div class="flex items-center justify-between flex-nowrap w-full">

      <!-- KIRI: Logo & Text -->
      <a href="/home" class="flex items-center gap-2 flex-shrink-0 cursor-pointer">
        <img src="/image/logo.png" alt="Logo" class="w-8 h-8" />
        <span class="font-sunshiney text-[20px] text-white">Tune Verse</span>
      </a>

      <!-- TENGAH: Home + Search + Plus + Profile -->
      <div class="flex items-center gap-2">
        <!-- Icon Home -->
        <a
          href="/home"
          class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 transition"
        >
          <img src="/image/ic_home.png" alt="Home" class="w-4 h-4" />
        </a>

        <!-- Search Bar -->
        <form
          @submit.prevent="handleSearch"
          class="flex items-center bg-[#8774B080] px-4 h-8 rounded-full flex-grow min-w-[150px] max-w-md"
        >
          <img src="/image/ic_search.png" alt="Search" class="w-4 h-4 mr-2" />
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search"
            class="bg-transparent text-white text-sm placeholder-white w-full h-full focus:outline-none border-none"
          />
        </form>

        <!-- Icon Plus -->
        <a
          href="/music/create"
          class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 transition"
        >
          <img src="/image/ic_plus.png" alt="Add" class="w-4 h-4" />
        </a>

        <!-- Icon Profile -->
        <a
          href="/profile"
          class="w-8 h-8 rounded-full bg-[#DBDDF580] flex items-center justify-center hover:opacity-70 transition"
        >
          <img src="/image/ic_profile.png" alt="Profile" class="w-4 h-4" />
        </a>
      </div>

      <!-- KANAN: Slogan -->
      <span class="text-white text-sm font-inter whitespace-nowrap ml-4">
        ~ Every verse begins with a tune.
      </span>

    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';

const searchQuery = ref('');

// Handle search redirect
const handleSearch = () => {
  const query = searchQuery.value.trim();
  if (query !== '') {
    // Navigasi manual ke halaman pencarian
    window.location.href = `/search?q=${encodeURIComponent(query)}`;
  }
};
</script>

<style scoped>
input:focus {
  outline: none;
  box-shadow: none;
  border: none;
}
</style>
