<script setup lang="ts">
const { title } = defineProps<{
  title: string;
}>();
</script>

<template>
  <UContainer>
    <h1 class="mb-6">
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
