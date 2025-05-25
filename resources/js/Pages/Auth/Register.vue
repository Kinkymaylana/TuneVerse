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
          <label class="block text-sm font-bold text-[#5B518D] mb-1">E-mail</label>
          <input v-model="email" type="email" required placeholder="E-mail" class="input" />
        </div>

        <div>
          <label class="block text-sm font-bold text-[#5B518D] mb-1">Password</label>
          <input v-model="password" type="password" required placeholder="Password" class="input" />
        </div>

        <div>
          <label class="block text-sm font-bold text-[#5B518D] mb-1">Username</label>
          <input v-model="username" type="text" required placeholder="Username" class="input" />
        </div>

        <button type="submit" class="btn-submit" :disabled="loading">
          {{ loading ? 'Mendaftar...' : 'Daftar' }}
        </button>

        <p v-if="error" class="text-red-600 text-sm text-center mt-2">{{ error }}</p>
        <p class="text-center text-sm mt-4">
          Sudah punya akun?
          <Link href="/login" class="text-[#5B518D] font-bold hover:underline">Masuk di sini</Link>
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
        const res = await fetch('http://localhost:3000/api/auth/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            email: this.email,
            password: this.password,
            username: this.username,
            displayName: this.username,
          }),
        });

        const data = await res.json();

        if (!res.ok) {
          if (data.errors?.length) {
            throw new Error(data.errors[0].msg);
          }
          throw new Error(data.message || 'Pendaftaran gagal');
        }

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
.input {
  width: 100%;
  padding: 10px;
  border: 1px solid #5B518D;
  border-radius: 8px;
  font-size: 14px;
}
.btn-submit {
  background-color: #F7B500;
  color: #5B518D;
  font-weight: bold;
  width: 100%;
  padding: 10px;
  border-radius: 8px;
}
</style>
