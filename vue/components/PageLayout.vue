<script setup lang="ts">
defineProps<{
  title: string;
}>();
</script>

<template>
  <v-app>
    <v-app-bar :elevation="0">
      <template #prepend>
        <v-app-bar-nav-icon to="/" flat>
            <img class="h-100 w-100" src="public/logoNoBG.png" />
        </v-app-bar-nav-icon>
      </template>

      <v-app-bar-title>
        <span class="navbar-brand-text my-auto">
          Brettspielverein
          <small>Zofingen</small>
        </span>
      </v-app-bar-title>

      <template #append>
        <v-btn icon="mdi-heart"></v-btn>
        <v-btn icon="mdi-magnify"></v-btn>
        <v-btn icon="mdi-dots-vertical"></v-btn>
      </template>
      <template #extension>
        <!-- This is just required to have the title bar be a bit thicker-->
      </template>
    </v-app-bar>
    <v-main>
      <v-container>
        <h1>{{ title }}</h1>
        <slot></slot>
      </v-container>
    </v-main>
    <v-footer class="bg-grey-lighten-1">
      <v-row justify="center" no-gutters>
        <v-col class="text-center mt-4" cols="12">
          {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
        </v-col>
      </v-row>
    </v-footer>
  </v-app>
</template>

<style>
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
