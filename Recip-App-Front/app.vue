<script setup>
import Header from '~/components/Header/Header.vue'
</script>

<template>
  <Header />
  <NuxtPage />
</template>

<style lang="scss">
@use '~/style/variable.scss' as v;

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: v.$text;
}

</style>
