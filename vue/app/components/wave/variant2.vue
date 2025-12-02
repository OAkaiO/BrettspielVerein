<script setup lang="ts">
const { lower = false, color } = defineProps<{
  lower?: boolean;
  color: string;
}>();

const calculatedColor = computed(() => {
  if (color.startsWith("--")) {
    return `var(${color})`;
  }
  else {
    return color;
  }
});
</script>

<template>
  <div>
    <svg
      viewBox="0 0 1265 144"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      :class="{ lower: lower }"
      class="w-100"
      preserveAspectRatio="none"
      style="height: 144px"
    >
      <path
        :fill="calculatedColor"
        d="M 0 40 C 164 40 164 20 328 20 L 328 20 L 328 0 L 0 0 Z"
        stroke-width="0"
      />
      <path
        :fill="calculatedColor"
        d="M 327 20 C 445.5 20 445.5 89 564 89 L 564 89 L 564 0 L 327 0 Z"
        stroke-width="0"
      />
      <path
        :fill="calculatedColor"
        d="M 563 89 C 724.5 89 724.5 48 886 48 L 886 48 L 886 0 L 563 0 Z"
        stroke-width="0"
      />
      <path
        :fill="calculatedColor"
        d="M 885 48 C 1006.5 48 1006.5 67 1128 67 L 1128 67 L 1128 0 L 885 0 Z"
        stroke-width="0"
      />
      <path
        :fill="calculatedColor"
        d="M 1127 67 C 1196 67 1196 0 1265 0 L 1265 0 L 1265 0 L 1127 0 Z"
        stroke-width="0"
      />
    </svg>
  </div>
</template>

<style scoped>
.lower {
  transform: rotate(180deg);
}

/* The line-height makes sure, that the svg is aligned with the bottom of the parent */
div {
  line-height: 0;
}
</style>
