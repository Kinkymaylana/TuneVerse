<template>
    <div class="min-h-screen bg-gradient-to-b from-[#FFFFFF] via-[#FFF9E2] to-[#FFF2CD]">
        <Navbar />
        <div class="px-6 py-10">
            <div class="max-w-xl mx-auto text-center">
                <img :src="coverImage" alt="Album Cover"
                    class="w-64 h-64 object-cover rounded-xl mx-auto mb-6 transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg" />
                <!-- Judul Lagu -->
                <h1 class="text-3xl font-spicy text-black mb-2">{{ judulLagu }}</h1>

                <!-- Nama Penyanyi -->
                <p class="text-3xl font-stalemate text-black mb-6">{{ penyanyi }}</p>

                <!-- Kontrol Musik -->
                <div class="bg-[#8774B080] rounded-xl px-6 py-4 mt-6 flex flex-col items-center">
                    <div class="flex items-center justify-center space-x-8 mb-2">
                        <button class="text-black hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 19l-9-7 9-7v14zm2-14h2v14h-2V5z" />
                            </svg>
                        </button>

                        <button class="text-black hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                        </button>

                        <button class="text-black hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l9 7-9 7V5zm-2 0H9v14h2V5z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Bar Progres Lagu -->
                    <div class="flex items-center w-full space-x-2 text-[10px] font-mono text-black">
                        <span>{{ durasiTerputar }}</span>
                        <div class="flex-1 h-1 bg-gray-200 rounded-full relative">
                            <div class="absolute left-0 top-0 h-1 bg-purple-600 rounded-full"
                                :style="{ width: progress }"></div>
                        </div>
                        <span>{{ durasiTotal }}</span>
                    </div>
                </div>

                <p class="text-[20px] italic font-medium text-purple-300 mt-6">
                    This Music was Created At {{ tanggal }} by user {{ user }}
                </p>

            </div>
        </div>
    </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue'

const judulLagu = 'Enchanted'
const penyanyi = 'Taylor Swift'
const tanggal = '25 May 2025 23.59'
const user = 'Angela'
const coverImage = '/image/sample_lagudetail.png'

const progress = '50%'             
const durasiTerputar = '2:33'     
const durasiTotal = '5:14'         
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Spicy+Rice&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Stalemate&display=swap');
</style>
