<script setup lang="ts">
const { alertData } = defineProps<{
  alertData: AlertStatus[];
}>();

const visibility = computed(() => alertData.length !== 0);
</script>

<template>
  <VContainer
    v-show="visibility"
    class="position-fixed"
    style="top: 60px; left: 50%; transform: translate(-50%, 0%); z-index: 20"
  >
    <VAlert
      v-for="alert in alertData"
      :text="alert.message"
      :type="alert.type"
      class="my-4"
    ></VAlert>
  </VContainer>
</template>

<style scoped></style>
