<script setup lang="ts">
const props = defineProps<{
  title: string;
}>();

const myself = useTemplateRef("myself");
const { top, bottom } = useElementBounding(myself);

defineExpose({ top, bottom });
</script>

<template>
  <VContainer ref="myself">
    <h1 class="mb-6">{{ title }}</h1>
    <slot></slot>
  </VContainer>
</template>

<style scoped>
h1 {
  text-align: center;
}
</style>
