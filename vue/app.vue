<script setup lang="ts">
const theme = useTheme();
</script>
<template>
  <v-app>
    <v-app-bar :elevation="0" color="header">
      <VContainer>
        <VRow>
          <VCol class="d-flex align-center justify-start">
            <VAppBarNavIcon to="/" class="invert">
              <img class="h-100 w-100" src="public/logoNoBG.png" />
            </VAppBarNavIcon>
            <VAppBarTitle class="ml-2">
              <span class="navbar-brand-text">
                Brettspielverein
                <small>Zofingen</small>
              </span>
            </VAppBarTitle>
          </VCol>
        </VRow>
      </VContainer>
    </v-app-bar>
    <v-main>
      <NuxtPage></NuxtPage>
    </v-main>
    <v-footer class="pa-0 footer">
      <v-container class="footer-content">
        <div>{{ new Date().getFullYear() }} — <strong>Vuetify</strong></div>
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

.footer {
  height: 100%;
  min-height: 240px;
  display: relative;
}

.footer-content {
  z-index: 1;
}

.invert {
  filter: brightness(0) invert(1);
}
</style>
