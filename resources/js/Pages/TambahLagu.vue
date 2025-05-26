<template>
  <div class="min-h-screen bg-gradient-to-b from-[#FFFFFF] via-[#FFFFFF] to-[#FFF2CD]">
    <Navbar />
    <div class="px-6 py-10">
      <div class="max-w-xl mx-auto">
        <h1 class="text-[40px] font-spicy text-[#3D236B] text-center mb-10">Simpan Lagu</h1>

        <form class="space-y-6" @submit.prevent="submitForm">
          <!-- Judul Lagu -->
          <div>
            <label class="block text-[16px] font-spicy text-[#3D236B] mb-1">Judul Lagu:</label>
            <input v-model="title" type="text" placeholder="Judul lagu"
              class="w-full px-4 py-2 border-2 border-[#3D236B] rounded-lg text-[#5B518D] font-spicy placeholder-[#5B518D] text-[16px]" />
          </div>

          <!-- Penyanyi -->
          <div>
            <label class="block text-[16px] font-spicy text-[#3D236B] mb-1">Penyanyi:</label>
            <input v-model="artist" type="text" placeholder="Nama penyanyi"
              class="w-full px-4 py-2 border-2 border-[#3D236B] rounded-lg text-[#5B518D] font-spicy placeholder-[#5B518D] text-[16px]" />
          </div>

          <!-- Unggah Lagu -->
          <div>
            <input ref="laguInput" type="file" accept=".mp3,audio/*" class="hidden" @change="handleLaguUpload" />
            <div @click="laguInput.click()"
              class="w-full h-28 border-2 px-6 border-[#3D236B] rounded-xl flex items-center justify-center gap-3 font-spicy text-[#3D236B] cursor-pointer hover:bg-[#FDF7E3] transition">
              <img src="/image/ic_music_note.png" alt="Music Icon" class="w-8 h-8" />
              <span class="text-[18px]">
                {{ laguName ? laguName : 'Unggah Lagu' }}
              </span>
            </div>
          </div>

          <!-- Unggah Gambar Album -->
          <div>
            <input ref="gambarInput" type="file" accept="image/*" class="hidden" @change="handleGambarUpload" />
            <div @click="gambarInput.click()"
              class="w-full h-28 border-2 px-6 border-[#3D236B] rounded-xl flex items-center justify-center gap-3 font-spicy text-[#3D236B] cursor-pointer hover:bg-[#FDF7E3] transition">
              <img src="/image/ic_upload.png" alt="Upload Icon" class="w-8 h-8" />
              <span class="text-[18px]">
                {{ gambarName ? gambarName : 'Unggah Gambar Album' }}
              </span>
            </div>
            <!-- Preview Gambar -->
            <div v-if="gambarPreview" class="mt-2">
              <img :src="gambarPreview" alt="Preview" class="w-32 h-32 rounded-md object-cover mx-auto" />
            </div>
          </div>

          <!-- Simpan Button -->
          <div class="text-center pt-4">
            <button type="submit"
              class="bg-[#F5C92A] text-[#3D236B] text-[32px] font-spicy px-8 py-2 rounded-xl hover:opacity-90 transition">
              Simpan
            </button>
          </div>

          <p v-if="errorMessage" class="text-red-500 text-center mt-2">{{ errorMessage }}</p>
          <p v-if="successMessage" class="text-green-600 text-center mt-2">{{ successMessage }}</p>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Navbar from '@/Components/Navbar.vue'

const title = ref('')
const artist = ref('')
const laguInput = ref(null)
const gambarInput = ref(null)
const laguFile = ref(null)
const gambarFile = ref(null)
const laguName = ref('')
const gambarName = ref('')
const gambarPreview = ref('')
const errorMessage = ref('')
const successMessage = ref('')

const handleLaguUpload = (e) => {
  const file = e.target.files[0]
  if (file) {
    laguFile.value = file
    laguName.value = file.name
  }
}

const handleGambarUpload = (e) => {
  const file = e.target.files[0]
  if (file) {
    gambarFile.value = file
    gambarName.value = file.name
    gambarPreview.value = URL.createObjectURL(file)
  }
}

const submitForm = async () => {
  errorMessage.value = ''
  successMessage.value = ''

  if (!title.value || !artist.value || !laguFile.value || !gambarFile.value) {
    errorMessage.value = 'Semua field harus diisi.'
    return
  }

  const formData = new FormData()
  formData.append('title', title.value)
  formData.append('artist', artist.value)
  formData.append('music', laguFile.value)
  formData.append('cover', gambarFile.value)

  try {
    const res = await fetch('http://localhost:3000/api/music', {
      method: 'POST',
      body: formData,
    })

    const data = await res.json()

    if (!res.ok) {
      throw new Error(data.message || 'Gagal menyimpan lagu.')
    }

    successMessage.value = data.message || 'Lagu berhasil disimpan!'
    // Reset form
    title.value = ''
    artist.value = ''
    laguFile.value = null
    gambarFile.value = null
    laguName.value = ''
    gambarName.value = ''
    gambarPreview.value = ''
  } catch (e) {
    errorMessage.value = e.message
  }
}
</script>
