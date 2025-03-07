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
        <VRow>
          <VCol>
            <LogoTextWrapper></LogoTextWrapper>
          </VCol>
          <VCol>
            <a href="/privacy">Datenschutzerklärung</a>
          </VCol>
          <VCol>
            <VContainer>
              <VRow class="justify-end">
                <VBtn class="ma-2" color="header" elevation="0" icon="mdi-instagram"
                  href="https://www.instagram.com/BrettspielZofingen" target="_blank"></VBtn>
              </VRow>
            </VContainer>
          </VCol>
        </VRow>
      </v-container>

      <WaveVariant1 lower :color="theme.current.value.colors.footer" class="w-100"
        style="position: absolute; bottom: 0px"></WaveVariant1>
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
