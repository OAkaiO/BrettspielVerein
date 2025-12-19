<script setup lang="ts">
const { variant } = defineProps<{
  variant: number;
}>();

const slots = useSlots();
</script>

<template>
  <div :class="[variant === 1 ? 'img1' : 'img2']">
    <WaveVariant1
      v-if="variant === 1"
      color="--ui-header"
    />
    <WaveVariant2
      v-else-if="variant === 2"
      color="--ui-bg"
    />
    <UContainer class="flex flex-wrap md:flex-nowrap gap-4">
      <BVZSheet class="sheet basis-full shrink-1 md:max-w-[calc(50%-var(--spacing)*2)]">
        <slot />
      </BVZSheet>
      <BVZSheet
        v-if="!!slots.right"
        class="sheet basis-full shrink-1 md:max-w-[calc(50%-var(--spacing)*2)]"
      >
        <slot name="right" />
      </BVZSheet>
    </UContainer>
    <WaveVariant1
      v-if="variant === 1"
      lower
      color="--ui-bg"
    />
    <WaveVariant2
      v-else-if="variant === 2"
      lower
      color="--ui-bg"
    />
  </div>
</template>

<style scoped>
@reference "tailwindcss";

.img1 {
  background-image: url("/img1.jpeg");
  background-size: cover;
  background-position: center;
}

.img2 {
  background-image: url("/img2.jpeg");
  background-size: cover;
  background-position: center;
}

.sheet{
  @apply bg-(--ui-bg)/85 backdrop-blur-[5px] backdrop-saturate-180 rounded-xl h-full;
}
</style>
