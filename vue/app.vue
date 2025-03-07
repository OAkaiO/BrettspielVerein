<script setup lang="ts">
const theme = useTheme();
</script>
<template>
  <v-app>
    <v-app-bar :elevation="0" color="header">
      <VContainer>
        <LogoTextWrapper onPrimary></LogoTextWrapper>
      </VContainer>
    </v-app-bar>
    <v-main>
      <NuxtPage></NuxtPage>
    </v-main>
    <v-footer class="pa-0 footer">
      <v-container class="footer-content">
        <LogoTextWrapper></LogoTextWrapper>
      </v-container>

      <WaveVariant1
        lower
        :color="theme.current.value.colors.footer"
        class="w-100"
        style="position: absolute; bottom: 0px"
      ></WaveVariant1>
    </v-footer>
  </v-app>
</template>

<style scoped>
.footer {
  height: 100%;
  min-height: 240px;
  display: relative;
}

.footer-content {
  z-index: 1;
}
</style>
