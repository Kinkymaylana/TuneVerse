<template>
  <div class="min-h-screen flex items-center justify-center bg-white px-4">
    <div class="w-full max-w-sm">
      <div class="text-center mb-6">
        <img src="/images/logo.png" alt="TuneVerse Logo" class="mx-auto w-20 h-auto mb-4" />
        <h2 class="font-spicyrice text-2xl text-[#5B518D] font-bold">LOGIN</h2>
        <p class="font-sunshiney text-base text-[#5B518D]">
          Step into the Verse — where every tune tells your story.
        </p>
      </div>

      <form @submit.prevent="handleLogin" class="space-y-6">
        <div>
          <label for="email" class="block text-sm font-bold text-[#5B518D] mb-2">E-mail</label>
          <input
            id="email"
            v-model="email"
            type="email"
            placeholder="E-mail"
            required
            autocomplete="username"
            class="block w-full px-4 py-3 border border-[#5B518D] rounded-lg placeholder:text-[#8C8C8C]
                   focus:outline-none focus:ring-2 focus:ring-[#5B518D]"
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
            autocomplete="current-password"
            class="block w-full px-4 py-3 border border-[#5B518D] rounded-lg placeholder:text-[#8C8C8C]
                   focus:outline-none focus:ring-2 focus:ring-[#5B518D]"
          />
          <div class="text-right mt-1">
            <a href="#" class="text-xs text-[#5B518D] hover:underline">Lupa Password?</a>
          </div>
        </div>

        <button
          type="submit"
          class="w-full bg-[#F7B500] text-[#5B518D] font-bold text-lg py-3 rounded-lg
                 disabled:opacity-50 disabled:cursor-not-allowed transition"
          :disabled="loading"
        >
          {{ loading ? 'Memuat...' : 'Masuk' }}
        </button>

        <p v-if="error" class="text-center text-sm text-red-600">{{ error }}</p>
        <p class="text-center text-sm text-[#555]">
          Belum punya akun?
          <Link href="/register" class="text-[#5B518D] font-bold hover:underline">
            Daftar di sini
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
      loading: false,
      error: null,
    };
  },
  methods: {
    async handleLogin() {
      this.loading = true;
      this.error = null;
      try {
        const response = await fetch('/api/login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
          body: JSON.stringify({ email: this.email, password: this.password }),
        });
        const data = await response.json();
        if (!response.ok) throw new Error(data.message || 'Login gagal');
        this.$inertia.visit('/dashboard');
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
