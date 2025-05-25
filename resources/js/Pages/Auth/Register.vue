<template>
  <div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="w-full max-w-sm">
      <div class="text-center mb-6">
        <img src="/images/logo.png" alt="TuneVerse Logo" class="mx-auto w-20 h-auto mb-4" />
        <h2 class="font-spicyrice text-2xl text-[#5B518D] font-bold">REGISTER</h2>
        <p class="font-sunshiney text-base text-[#5B518D]">
          Step into the Verse — where every tune tells your story.
        </p>
      </div>

      <form @submit.prevent="handleRegister" class="space-y-6">
        <div>
          <label for="email" class="block text-sm font-bold text-[#5B518D] mb-2">E-mail</label>
          <input
            id="email"
            v-model="email"
            type="email"
            placeholder="E-mail"
            required
            class="block w-full px-4 py-3 border border-[#5B518D] rounded-lg placeholder:text-[#8C8C8C]"
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-bold text-[#5B518D] mb-2">Password</label>
          <input
            id="password"
            v-model="password"
            type="password"
            placeholder="Password"
            required
            class="block w-full px-4 py-3 border border-[#5B518D] rounded-lg placeholder:text-[#8C8C8C]"
          />
        </div>

        <div>
          <label for="username" class="block text-sm font-bold text-[#5B518D] mb-2">Username</label>
          <input
            id="username"
            v-model="username"
            type="text"
            placeholder="Username"
            required
            class="block w-full px-4 py-3 border border-[#5B518D] rounded-lg placeholder:text-[#8C8C8C]"
          />
        </div>

        <button
          type="submit"
          class="w-full bg-[#F7B500] text-[#5B518D] font-bold text-lg py-3 rounded-lg
                 disabled:opacity-50 disabled:cursor-not-allowed transition"
          :disabled="loading"
        >
          {{ loading ? 'Mendaftar...' : 'Daftar' }}
        </button>

        <p v-if="error" class="text-center text-sm text-red-600">{{ error }}</p>
        <p class="text-center text-sm text-[#555]">
          Sudah punya akun?
          <Link href="/login" class="text-[#5B518D] font-bold hover:underline">
            Masuk di sini
          </Link>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  components: { Link },
  data() {
    return {
      email: '',
      password: '',
      username: '',
      loading: false,
      error: null,
    };
  },
  methods: {
    async handleRegister() {
      this.loading = true;
      this.error = null;
      try {
        const res = await fetch('/api/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
          body: JSON.stringify({
            email: this.email,
            password: this.password,
            username: this.username,
          }),
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || 'Pendaftaran gagal');
        this.$inertia.visit('/login');
      } catch (e) {
        this.error = e.message;
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
input::placeholder {
  color: #8C8C8C;
}
</style>
