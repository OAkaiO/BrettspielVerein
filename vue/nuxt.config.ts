import { type ThemeDefinition } from 'vuetify'
// https://nuxt.com/docs/api/configuration/nuxt-config
const myCustomLightTheme : ThemeDefinition = {
  dark: false,
  colors: {
    primary: "#745B0C",
    surfaceTint: "#745B0C",
    onPrimary: "#FFFFFF",
    primaryContainer: "#FFDF91",
    onPrimaryContainer: "#594400",
    secondary: "#6A5D3F",
    onSecondary: "#FFFFFF",
    secondaryContainer: "#F2E1BB",
    onSecondaryContainer: "#51462A",
    tertiary: "#486649",
    onTertiary: "#FFFFFF",
    tertiaryContainer: "#C9ECC8",
    onTertiaryContainer: "#304D33",
    error: "#BA1A1A",
    onError: "#FFFFFF",
    errorContainer: "#FFDAD6",
    onErrorContainer: "#93000A",
    background: "#FFF8F1",
    onBackground: "#1F1B13",
    surface: "#FFF8F1",
    onSurface: "#1F1B13",
    surfaceVariant: "#ECE1CF",
    onSurfaceVariant: "#4C4639",
    outline: "#7E7667",
    outlineVariant: "#CFC5B4",
    shadow: "#000000",
    scrim: "#000000",
    inverseSurface: "#343027",
    inverseOnSurface: "#F9F0E2",
    inversePrimary: "#E4C36C",
    primaryFixed: "#FFDF91",
    onPrimaryFixed: "#241A00",
    primaryFixedDim: "#E4C36C",
    onPrimaryFixedVariant: "#594400",
    secondaryFixed: "#F2E1BB",
    onSecondaryFixed: "#231B04",
    secondaryFixedDim: "#D6C5A0",
    onSecondaryFixedVariant: "#51462A",
    tertiaryFixed: "#C9ECC8",
    onTertiaryFixed: "#04210B",
    tertiaryFixedDim: "#AECFAD",
    onTertiaryFixedVariant: "#304D33",
    surfaceDim: "#E1D9CC",
    surfaceBright: "#FFF8F1",
    surfaceContainerLowest: "#FFFFFF",
    surfaceContainerLow: "#FCF2E5",
    surfaceContainer: "#F6EDDF",
    surfaceContainerHigh: "#F0E7D9",
    surfaceContainerHighest: "#EAE1D4",
    header: "#3D405B",
    lower: "#81B29A"
  }
};

export default defineNuxtConfig({
  compatibilityDate: "2024-11-01",
  css: ["./assets/main.css"],
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
  vuetify: {
    vuetifyOptions: {
      theme: {
        defaultTheme: "myCustomLightTheme",
        themes: {
          myCustomLightTheme
        },
      },
    },
  },
});
