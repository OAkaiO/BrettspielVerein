<script setup lang="ts">
const goTo = useOffsetGoTo();

const page = ref();
const sections = computed(() => page.value?.pageRef.sections);

const { arrivedState } = useWindowScroll();
const scrolledOverState = computed(() => {
  return sections.value?.map(
    (element: any, index: number) =>
      element.bottom < 51 ||
      (index != Object.keys(sections.value).length - 1 && arrivedState.bottom)
  );
});
</script>

<template>
  <VApp>
    <VAppBar :elevation="0" color="header">
      <VContainer>
        <VRow class="align-center justify-space-between px-4">
            <LogoTextWrapper onPrimary></LogoTextWrapper>
          <div class="nav-container" v-if="!!sections">
            <div
              class="hover-link d-inline mx-2"
              @click="goTo(0)"
              :class="{ 'scrolled-over': sections[0].top < 51 }"
            >
              Home
            </div>
            <div
              v-for="(sec, index) in sections"
              class="hover-link d-inline mx-2"
              @click="goTo(sec)"
              :class="{ 'scrolled-over': scrolledOverState[index] }"
            >
              {{ sec?.$props.title }}
            </div>
          </div>
        </VRow>
      </VContainer>
    </VAppBar>
    <VMain ref="myself">
      <NuxtPage ref="page"></NuxtPage>
    </VMain>
    <VFooter class="footer pa-0">
      <PageFooter></PageFooter>
    </VFooter>
  </VApp>
</template>
<style scoped>
.footer {
  height: 100%;
  min-height: 240px;
  display: relative;
}

.nav-container :nth-child(1 of :not(.scrolled-over)) {
  color: rgb(var(--v-theme-primary));
}
</style>
