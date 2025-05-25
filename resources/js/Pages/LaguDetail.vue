<template>
  <div class="min-h-screen relative overflow-auto text-white text-center font-inter text-sm">
    <!-- Canvas for abstract starfield -->
    <canvas ref="starfield" class="absolute inset-0 w-full h-full"></canvas>

    <Navbar />

    <!-- Back Button (below navbar, minimal round icon) -->
    <div class="px-6 py-2 relative z-10 text-left">
      <Link href="/home">
        <button class="p-2 bg-white bg-opacity-30 hover:bg-opacity-50 rounded-full transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
      </Link>
    </div>

    <!-- Glassmorphism Card -->
    <div v-if="music" class="px-6 py-4 -mt-4 relative z-10">
      <div class="max-w-md mx-auto bg-white bg-opacity-20 backdrop-blur-lg rounded-3xl p-6 shadow-2xl">
        <!-- Cover Image -->
        <img
          :src="music.imageUrl"
          alt="Album Cover"
          class="w-48 h-48 object-cover rounded-xl mx-auto mb-4 transform transition hover:scale-105 hover:shadow-lg"
        />

        <!-- Title & Artist -->
        <h1 class="text-xl font-inter font-semibold mb-1">{{ music.title }}</h1>
        <p class="text-base font-inter font-light mb-4">{{ music.artist }}</p>

        <!-- Hidden Audio Element -->
        <audio
          ref="audio"
          :src="music.musicUrl"
          @loadedmetadata="onLoadedMetadata"
          @timeupdate="onTimeUpdate"
        ></audio>

        <!-- Player Controls -->
        <div class="bg-white bg-opacity-30 rounded-xl px-4 py-3 mt-4 flex flex-col items-center">
          <div class="flex items-center justify-center space-x-4 mb-1">
            <button @click="seek(0)" class="p-2 bg-white bg-opacity-50 rounded-full hover:bg-opacity-70 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-9-7 9-7v14z" />
              </svg>
            </button>
            <button @click="togglePlay" class="p-2 bg-white bg-opacity-50 rounded-full hover:bg-opacity-70 transition">
              <template v-if="!isPlaying">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M8 5v14l11-7z" />
                </svg>
              </template>
              <template v-else>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                </svg>
              </template>
            </button>
            <button @click="seek(durationSec)" class="p-2 bg-white bg-opacity-50 rounded-full hover:bg-opacity-70 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l9 7-9 7V5zm-2 0H9v14h2V5z" />
              </svg>
            </button>
          </div>
          <div class="flex items-center w-full space-x-2 text-xs">
            <span>{{ formatTime(currentTimeSec) }}</span>
            <div
              ref="progressBar"
              class="flex-1 h-1.5 bg-gray-300 rounded-full relative cursor-pointer"
              @click="onSeekBarClick"
            >
              <div
                class="absolute left-0 top-0 h-full bg-purple-600 rounded-full transition-all"
                :style="{ width: progressPercent + '%' }"
              ></div>
            </div>
            <span>{{ formatTime(durationSec) }}</span>
          </div>
        </div>

        <!-- Created Date & User -->
        <p class="italic font-inter font-light text-xs mt-4">
          Lagu dibuat pada {{ createdDate }} oleh {{ music.username }}
        </p>
      </div>
    </div>

    <div v-else class="text-center mt-24 relative z-10">
      Loading or music not found...
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'
import Navbar from '@/Components/Navbar.vue'

const { id } = usePage().props.value
const starfield      = ref(null)
const music          = ref(null)
const audio          = ref(null)
const progressBar    = ref(null)
const isPlaying      = ref(false)
const currentTimeSec = ref(0)
const durationSec    = ref(0)
const createdDate    = ref('')

onMounted(() => {
  const canvas = starfield.value
  const ctx    = canvas.getContext('2d')
  canvas.width  = window.innerWidth
  canvas.height = window.innerHeight
  for (let i = 0; i < 200; i++) {
    const x = Math.random() * canvas.width
    const y = Math.random() * canvas.height
    const r = Math.random() * 1.5 + 0.5
    ctx.fillStyle  = `rgba(255,255,255,${Math.random() * 0.7 + 0.2})`
    ctx.beginPath()
    ctx.arc(x, y, r, 0, 2 * Math.PI)
    ctx.fill()
  }

  fetch(`http://localhost:3000/api/music/${id}`)
    .then(res => { if (!res.ok) throw new Error(res.statusText); return res.json() })
    .then(data => {
      music.value = data
      if (data.createdAt && data.createdAt._seconds) {
        const d = new Date(data.createdAt._seconds * 1000)
        createdDate.value = d.toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })
      }
    })
    .catch(err => console.error('Gagal fetch music:', err))
})

function onLoadedMetadata() { durationSec.value = audio.value.duration }
function onTimeUpdate()     { currentTimeSec.value = audio.value.currentTime }
function togglePlay()       { if (audio.value) { isPlaying.value ? audio.value.pause() : audio.value.play(); isPlaying.value = !isPlaying.value } }
function seek(time)         { audio.value && (audio.value.currentTime = time) }
function onSeekBarClick(e)  { const rect = progressBar.value.getBoundingClientRect(); seek(((e.clientX - rect.left) / rect.width) * durationSec.value) }
const progressPercent      = computed(() => durationSec.value ? (currentTimeSec.value / durationSec.value) * 100 : 0)
function formatTime(s)      { const m = Math.floor(s/60); const sec = Math.floor(s%60); return `${m}:${String(sec).padStart(2,'0')}` }
</script>

<style>
html, body { width:100%; height:auto; min-height:100%; margin:0; padding:0; }
body {
  background: linear-gradient(-45deg, #090b1f, #14144e, #45207d, #14144e);
  background-size: 400% 400%;
  animation: gradient 30s ease infinite;
}
@keyframes gradient { 0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%} }
canvas { position:absolute; top:0; left:0; }
</style>
