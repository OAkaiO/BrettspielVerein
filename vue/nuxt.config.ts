// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: "2024-11-01",
  css: [
    "./assets/main.css"
  ],
  devtools: { enabled: true },
  experimental: {
    payloadExtraction: false,
  },
  modules: ["vuetify-nuxt-module"],
  nitro: {
    prerender: {
      ignore: ["/200.html", "/404.html"],
    },
  },
});
