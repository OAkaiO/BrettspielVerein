<script setup lang="ts">
const { data } = defineProps<{ data: EventData }>();
</script>

<template>
  <UContainer class="flex gap-4 flex-col-reverse sm:flex-row shadow-lg rounded-xl py-4">
    <img
      src="/Logo1.png"
      class="max-w-[13rem] self-center"
    >
    <EventDetails :data />
  </UContainer>
</template>
