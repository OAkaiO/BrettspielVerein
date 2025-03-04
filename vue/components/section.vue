<script setup lang="ts">
const props = defineProps<{
  title: string;
}>();
</script>

<template>
  <div>
      <v-container>
        <h1 class="mb-6">{{ title }}</h1>
        <slot></slot>
      </v-container>
  </div>
</template>

<style scoped>
h1 {
  text-align: center;
}
</style>
