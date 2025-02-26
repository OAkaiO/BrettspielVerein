<template>
  <v-app>
    <v-app-bar :elevation="0" color="header">
      <template #prepend>
        <v-app-bar-nav-icon to="/">
          <img class="h-100 w-100" src="public/logoNoBG.png" />
        </v-app-bar-nav-icon>
      </template>

      <VAppBarTitle>
        <span class="navbar-brand-text my-auto">
          Brettspielverein
          <small>Zofingen</small>
        </span>
      </VAppBarTitle>

      <template #append>
        <slot name="titlebar"></slot>
      </template>
      <template #extension>
        <!-- This is just required to have the title bar be a bit thicker-->
      </template>
    </v-app-bar>
    <v-main>
      <NuxtPage></NuxtPage>
    </v-main>
    <v-footer class="bg-lower">
      <v-row justify="center" no-gutters>
        <v-col class="text-center mt-4" cols="12">
          {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
        </v-col>
      </v-row>
    </v-footer>
  </v-app>
</template>

<style scoped>
.navbar-brand-text {
  line-height: normal;
  position: relative;
  bottom: 5px;
}

.navbar-brand-text small {
  display: block;
  font-size: 10px;
  line-height: 1;
  text-transform: uppercase;
}
</style>
