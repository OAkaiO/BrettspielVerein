<script setup lang="ts">
const goTo = useOffsetGoTo();

const { headers, registrator } = useNavHeaderList();

const { arrivedState } = useWindowScroll();
const scrolledOverState = computed(() => {
  return headers.value?.map(
    (element: HeaderSpec, index: number) =>
      element.ref.top < 51 ||
      (index == Object.keys(headers.value).length - 1 && arrivedState.bottom)
  );
});
const drawerVisibility = ref(false);
const { mdAndUp } = useDisplay();
</script>

<template>
  <VApp>
    <VAppBar :elevation="0" color="header">
      <VContainer>
        <VRow class="align-center justify-space-between px-4">
          <LogoTextWrapper onPrimary></LogoTextWrapper>
          <div class="nav-container" v-if="headers?.length !== 0">
            <template v-if="mdAndUp">
              <div
                class="hover-link scrolled-over d-inline mx-2"
                @click="goTo(0)"
              >
                Home
              </div>
              <div
                v-for="(sec, index) in headers"
                class="hover-link d-inline mx-2"
                @click="goTo(sec.ref)"
                :class="{ 'scrolled-over': scrolledOverState[index] }"
              >
                {{ sec?.displayName }}
              </div>
            </template>
            <VBtn
              v-else
              @click.stop="drawerVisibility = !drawerVisibility"
              icon="mdi-menu"
            ></VBtn>
          </div>
        </VRow>
      </VContainer>
    </VAppBar>
    <VNavigationDrawer v-model="drawerVisibility" location="right" temporary>
      <VList class="nav-container">
        <VListItem class="hover-link scrolled-over" @click="goTo(0)">
          Home
        </VListItem>
        <VListItem
          v-for="(section, index) in headers"
          @click="goTo(section.ref)"
          class="hover-link"
          :class="{ 'scrolled-over': scrolledOverState[index] }"
        >
          {{ section.displayName }}
        </VListItem>
      </VList>
    </VNavigationDrawer>
    <VMain ref="myself">
      <NuxtPage :navRegistrator="registrator"></NuxtPage>
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

.nav-container :nth-last-child(1 of .scrolled-over) {
  color: rgb(var(--v-theme-primary));
}
</style>
