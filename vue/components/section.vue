<script setup lang="ts">
const props = defineProps<{
  title: string;
}>();
</script>

<template>
  <VContainer>
    <h1 class="mb-6">{{ title }}</h1>
    <slot></slot>
  </VContainer>
</template>

<style scoped>
h1 {
  text-align: center;
}
</style>
