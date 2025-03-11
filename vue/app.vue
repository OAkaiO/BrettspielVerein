<script setup lang="ts">
const page = ref();
const sections = computed(() => page.value?.pageRef.sections);

const goTo = useOffsetGoTo();
</script>
<template>
  <v-app>
    <VAppBar :elevation="0" color="header">
      <VContainer>
        <VRow class="align-center">
          <VCol>
            <LogoTextWrapper onPrimary></LogoTextWrapper>
          </VCol>
          <VCol>
            <div
              v-if="!!sections"
              class="hover-link d-inline mx-2"
              @click="goTo(0)"
            >
              Home
            </div>
            <div
              v-if="!!sections"
              v-for="sec in sections"
              class="hover-link d-inline mx-2"
              @click="goTo(sec)"
            >
              {{ sec?.$props.title }}
            </div>
          </VCol>
        </VRow>
      </VContainer>
    </VAppBar>
    <VMain>
      <NuxtPage ref="page"></NuxtPage>
    </VMain>
    <VFooter class="footer pa-0">
      <PageFooter></PageFooter>
    </VFooter>
  </v-app>
</template>
<style scoped>
.footer {
  height: 100%;
  min-height: 240px;
  display: relative;
}
</style>
