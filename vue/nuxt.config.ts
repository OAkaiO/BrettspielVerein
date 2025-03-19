import { type ThemeDefinition } from "vuetify";
// https://nuxt.com/docs/api/configuration/nuxt-config
const myCustomLightTheme: ThemeDefinition = {
  dark: false,
  colors: {
    primary: "#F2CC8F",
    surfaceTint: "#745B0C",
    onPrimary: "#FFFFFF",
    primaryContainer: "#FFDF91",
    onPrimaryContainer: "#594400",
    secondary: "#F4F1DE",
    onSecondary: "#FFFFFF",
    secondaryContainer: "#F2E1BB",
    onSecondaryContainer: "#51462A",
    tertiary: "#486649",
    onTertiary: "#FFFFFF",
    tertiaryContainer: "#C9ECC8",
    onTertiaryContainer: "#304D33",
    error: "#E56666",
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
    footer: "#81B29A",
  },
  variables: {
    "activated-opacity": 0,
  },
};

export default defineNuxtConfig({
  compatibilityDate: "2024-11-01",
  css: ["./assets/css/global.scss"],
  devServer: {
    port: 8000
  },
  devtools: {
    enabled: true,
  },
  experimental: {
    payloadExtraction: false,
  },
  fonts: {
    defaults: {
      weights: [400],
      styles: ["normal", "italic"],
      subsets: [
        "cyrillic-ext",
        "cyrillic",
        "greek-ext",
        "greek",
        "vietnamese",
        "latin-ext",
        "latin",
      ],
    },
    families: [{ name: "DM Sans" }],
  },
  imports: {
    dirs: ['types/*.ts'],
  },
  modules: ["vuetify-nuxt-module", "@nuxt/fonts", "@vueuse/nuxt"],
  nitro: {
    prerender: {
      ignore: ["/200.html", "/404.html"],
    },
  },
  vuetify: {
    moduleOptions: {
      disableVuetifyStyles: true,
      styles: {
        configFile: "assets/css/components.scss",
      },
    },
    vuetifyOptions: {
      defaults: {
        global: {
          ripple: false,
        },
      },
      theme: {
        defaultTheme: "myCustomLightTheme",
        themes: {
          myCustomLightTheme,
        },
        variations: {
          colors: ["primary", "secondary"],
          lighten: 0,
          darken: 1,
        },
      },
    },
  },
});