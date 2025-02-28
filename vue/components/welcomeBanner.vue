<script setup lang="ts">
const activeIndex = ref(0);

const { xs } = useDisplay();

function updateActiveIndex(event: any) {
  activeIndex.value = event;
}

// Used to revert the direction of the transition, to have uni-directional scrolling
const isFirstElementActive = computed(() => {
  return activeIndex.value == 0;
});
</script>

<template>
  <v-container>
    <v-row>
      <v-col :cols="xs ? 12 : 6">
        <h1 class="text-white">Willkommen beim Brettspielverein Zofingen</h1>
        <h2 class="text-white">
          <span>Brettspiele</span>
          <v-carousel
            cycle
            continuous
            :direction="'vertical'"
            hide-delimiter-background
            hide-delimiters
            :interval="4500"
            :show-arrows="false"
            :height="60"
            :reverse="isFirstElementActive"
            @update:model-value="updateActiveIndex"
          >
            <div class="title-color-wrapper">
              <v-carousel-item>machen Spass</v-carousel-item>
              <v-carousel-item>verbinden uns</v-carousel-item>
            </div>
          </v-carousel>
        </h2>
      </v-col>
    </v-row>
  </v-container>
</template>
<style scoped>
.title-color-wrapper {
  color: rgb(var(--v-theme-primary));
}
</style>
