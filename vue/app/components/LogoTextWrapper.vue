<script setup lang="ts">
const { light = false } = defineProps<{
  light?: boolean;
}>();
</script>

<template>
  <div class="flex flex-row items-center">
    <img
      :class="{ invert: light }"
      :style="`width: 50px; display: inline;`"
      src="/logoNoBG.png"
    >
    <span
      class="navbar-brand-text"
      :class="light ? 'text-white' : 'text-black'"
    >
      Brettspielverein
      <small>Zofingen</small>
    </span>
  </div>
</template>

<style scoped>
.navbar-brand-text {
  line-height: normal;
  position: relative;
  bottom: 5px;
  font-weight: bold;
}

.navbar-brand-text small {
  display: block;
  font-size: 10px;
  line-height: 1;
  text-transform: uppercase;
}

.invert {
  filter: brightness(0) invert(1);
}
</style>
