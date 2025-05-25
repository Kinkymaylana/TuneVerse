<template>
  <div id="auth-app-container">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'AppAuth',
};
</script>

<style>
#auth-app-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  width: 100%;
}
</style>
