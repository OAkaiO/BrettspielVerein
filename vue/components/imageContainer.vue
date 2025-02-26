<script setup lang="ts">
const props = defineProps<{
  variant?: Number;
}>();

const theme = useTheme();
</script>

<template>
  <div :class="[variant === 1 ? 'img1' : 'img2']">
    <WaveVariant1 v-if="variant === 1" :color="theme.current.value.colors.header"></WaveVariant1>
    <WaveVariant2 v-else-if="variant === 2" :color="theme.current.value.colors.background"></WaveVariant2>
    <v-container>
      <slot></slot>
    </v-container>
    <WaveVariant1 v-if="variant === 1" lower :color="theme.current.value.colors.background"></WaveVariant1>
    <WaveVariant2 v-else-if="variant === 2" lower :color="theme.current.value.colors.background"></WaveVariant2>
  </div>
</template>
<style>
.img1 {
  background-image: url("../public/img1.jpeg");
  background-size: cover;
  background-position: center;
}

.img2 {
  background-image: url("../public/img2.jpeg");
  background-size: cover;
  background-position: center;
}
</style>
