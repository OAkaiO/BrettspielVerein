<script setup lang="ts">
const { lower = false, color } = defineProps<{
  lower?: boolean;
  color: string;
}>();

const calculatedColor = computed(() => {
  return wrapColorForTailwind(color);
});
</script>

<template>
  <div>
    <svg
      v-if="lower"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1440 229"
      preserveAspectRatio="none"
      style="height: 230px; width: 100%"
    >
      <path
        :fill="calculatedColor"
        fill-opacity="1"
        d="M0 134 34.3 102C68.6 70 137 6 206 .7 274.3-5 343 49 411 54 480 59 549 17 617 32.7 685.7 49 754 123 823 150 891.4 177 960 155 1029 134 1097.1 113 1166 91 1234 70 1302.9 49 1371 27 1406 16.7L1440 6 1440 230 0 230Z"
      />
    </svg>
    <svg
      v-else
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 1440 320"
      preserveAspectRatio="none"
      style="height: 320px; width: 100%"
    >
      <path
        :fill="calculatedColor"
        fill-opacity="1"
        d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"
      />
    </svg>
  </div>
</template>

<style scoped>
/* The line-height makes sure, that the svg is aligned with the bottom of the parent */
div {
  line-height: 0;
}
</style>
