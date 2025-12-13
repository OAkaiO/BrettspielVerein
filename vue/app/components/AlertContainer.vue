<script setup lang="ts">
const { alertData } = defineProps<{
  alertData: AlertStatus[];
}>();
</script>

<template>
  <UContainer
    class="fixed top-30 z-1200 w-screen lg:left-1/2 lg:-translate-x-1/2"
  >
    <UAlert
      v-for="alert in alertData"
      :key="alert.message"
      :title="alert.message"
      :color="alert.type"
      class="my-4"
    />
  </UContainer>
</template>
