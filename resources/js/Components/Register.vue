<template>
  <div class="auth-form">
    <div class="logo-container">
      <img src="/images/logo.png" alt="TuneVerse Logo" class="logo" />
    </div>
    <h2 class="font-spicyrice text-[48px] text-[#5B518D] font-bold mb-2">REGISTER</h2>
    <p class="font-sunshiney text-[20px] text-[#5B518D]">Step into the Verse — where every tune tells your story.</p>

    <form @submit.prevent="handleRegister">
      <div class="form-group">
        <label for="reg-email">E-mail</label>
        <input type="email" id="reg-email" v-model="email" placeholder="E-mail" required />
      </div>
      <div class="form-group">
        <label for="reg-password">Password</label>
        <input type="password" id="reg-password" v-model="password" placeholder="Password" required />
      </div>
      <div class="form-group">
        <label for="reg-username">Username</label>
        <input type="text" id="reg-username" v-model="username" placeholder="Username" required />
      </div>
      <button type="submit" class="btn-submit" :disabled="loading">
        {{ loading ? 'Mendaftar...' : 'Daftar' }}
      </button>
      <p v-if="error" class="error-message">{{ error }}</p>
      <p class="auth-link">Sudah punya akun? <router-link to="/auth/login">Masuk di sini</router-link></p>
    </form>
  </div>
</template>

<script>
import { createUserWithEmailAndPassword, updateProfile } from 'firebase/auth';
import { doc, setDoc } from 'firebase/firestore'; // Import Firestore functions
import { auth, db } from '../firebase/config'; // Import auth dan db dari konfigurasi Firebase

export default {
  name: 'RegisterForm',
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
        const userCredential = await createUserWithEmailAndPassword(auth, this.email, this.password);
        const user = userCredential.user;

        // Set display name untuk user di Firebase Auth
        await updateProfile(user, {
          displayName: this.username,
        });

        // Simpan data user tambahan (username, email) ke Firestore
        await setDoc(doc(db, 'users', user.uid), {
          username: this.username,
          email: this.email,
          createdAt: new Date(),
        });

        console.log('Registration successful:', user);
        // Redirect ke halaman login
        this.$router.push('/Login');
      } catch (error) {
        console.error('Registration failed:', error.message);
        this.error = this.getFirebaseErrorMessage(error.code);
      } finally {
        this.loading = false;
      }
    },
    getFirebaseErrorMessage(code) {
      switch (code) {
        case 'auth/email-already-in-use':
          return 'Email ini sudah terdaftar.';
        case 'auth/invalid-email':
          return 'Format email tidak valid.';
        case 'auth/weak-password':
          return 'Password terlalu lemah (minimal 6 karakter).';
        default:
          return 'Terjadi kesalahan saat pendaftaran. Silakan coba lagi.';
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

.logo {
  width: 100px;
  height: auto;
}

.form-title {
  color: #5d3f6a;
  font-size: 2.2em;
  margin-bottom: 5px;
  font-weight: bold;
  display: flex;
  justify-content: center;
  align-items: center;
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
