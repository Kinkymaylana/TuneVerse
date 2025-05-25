<template>
  <div class="auth-form">
    <div class="logo-container">
      <img src="/images/logo.png" alt="TuneVerse Logo" class="logo" />
    </div>
    <h2 class="font-spicyrice text-[24px] text-[#5B518D]" font-bold>LOGIN</h2>
    <p class="font-sunshiney text-[20px] text-[#5B518D]">Step into the Verse — where every tune tells your story.</p>

    <form @submit.prevent="handleLogin">
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" v-model="email" placeholder="E-mail" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" v-model="password" placeholder="Password" required />
        <a href="#" class="forgot-password">Lupa Password?</a>
      </div>
      <button type="submit" class="btn-submit" :disabled="loading">
        {{ loading ? 'Memuat...' : 'Masuk' }}
      </button>
      <p v-if="error" class="error-message">{{ error }}</p>
      <p class="auth-link">Belum punya akun? <router-link to="/auth/register">Daftar di sini</router-link></p>
    </form>
  </div>
</template>

<script>
import { signInWithEmailAndPassword } from 'firebase/auth';
import { auth } from '../firebase/config'; // Import auth dari konfigurasi Firebase

export default {
  name: 'LoginForm',
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
        const userCredential = await signInWithEmailAndPassword(auth, this.email, this.password);
        console.log('Login successful:', userCredential.user);
        this.$router.push('/bootstrap/app.php');
      } catch (error) {
        console.error('Login failed:', error.message);
        this.error = this.getFirebaseErrorMessage(error.code);
      } finally {
        this.loading = false;
      }
    },
    getFirebaseErrorMessage(code) {
      switch (code) {
        case 'auth/user-not-found':
          return 'Email tidak terdaftar.';
        case 'auth/wrong-password':
          return 'Password salah.';
        case 'auth/invalid-email':
          return 'Format email tidak valid.';
        case 'auth/user-disabled':
          return 'Akun ini telah dinonaktifkan.';
        default:
          return 'Terjadi kesalahan saat login. Silakan coba lagi.';
      }
    }
  },
};
</script>

<style scoped>

.logo-container {
  margin-bottom: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Asumsi gambar logo berada di public/images/tuneverse-logo.png */
.logo {
  width: 100px;
  height: auto;
}

.form-title {
  color: #5d3f6a;
  font-size: 2.2em;
  margin-bottom: 5px;
  font-weight: bold;
}

.tagline {
  color: #777;
  font-size: 0.9em;
  margin-bottom: 30px;
}

.form-group {
  text-align: left;
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  font-size: 0.9em;
  color: #555;
  margin-bottom: 8px;
}

.form-group input {
  width: calc(100% - 20px);
  padding: 12px 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1em;
}

.form-group input::placeholder {
  color: #bbb;
}

.forgot-password {
  display: block;
  text-align: right;
  margin-top: 10px;
  color: #f7b500;
  text-decoration: none;
  font-size: 0.85em;
}

.btn-submit {
  background-color: #f7b500;
  color: #fff;
  border: none;
  padding: 15px 30px;
  border-radius: 10px;
  font-size: 1.1em;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: 100%;
  margin-top: 20px;
}

.btn-submit:hover:not(:disabled) {
  background-color: #e6a700;
}

.btn-submit:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

.error-message {
  color: red;
  font-size: 0.85em;
  margin-top: 10px;
}

.auth-link {
  margin-top: 20px;
  font-size: 0.9em;
  color: #555;
}

.auth-link a {
  color: #f7b500;
  text-decoration: none;
  font-weight: bold;
}

.auth-link a:hover {
  text-decoration: underline;
}
</style>
