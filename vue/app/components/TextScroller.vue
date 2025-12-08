<script setup lang="ts">
const { items, duration = 4500 } = defineProps<{
  items: string[];
  duration?: number;
}>();

const index = ref(0);
const fading = ref(false);

function rotate() {
  fading.value = true;
  setTimeout(() => {
    index.value = (index.value + 1) % items.length;
    fading.value = false;
  }, 500);
}

onMounted(() => {
  setInterval(rotate, duration);
});
</script>

<template>
  <div
    id="rotator"
    :class="{ 'fade-out': fading }"
  >
    {{ items[index] }}
  </div>
</template>

<style>
#rotator {
  transition: opacity 0.5s ease;
}

.fade-out {
  opacity: 0;
}
</style>
