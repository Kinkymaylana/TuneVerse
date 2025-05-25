<template>
  <div class="page-container register-page">
    <RegisterForm/>
  </div>
</template>

<script>
import RegisterForm from '../Components/Register.vue';

export default {
  name: 'RegisterPage',
  components: {
    RegisterForm,
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
