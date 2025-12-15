<script setup lang="ts">
const { title } = defineProps<{
  title: string;
}>();
</script>

<template>
  <UContainer class="my-4">
    <h1 class="mb-4">
      {{ title }}
    </h1>
    <slot />
  </UContainer>
</template>

<style scoped>
h1 {
  text-align: center;
}
</style>
