<template>
  <div class="page-container login-page">
    <LoginForm />
  </div>
</template>

<script>
import LoginForm from '../Components/Login.vue';

export default {
  name: 'LoginPage',
  components: {
    LoginForm,
  },
};
</script>

<style scoped>
/* Styling dari jawaban sebelumnya */
.page-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; /* Pastikan mengisi tinggi viewport */
  padding: 20px;
  box-sizing: border-box;
}
</style>
