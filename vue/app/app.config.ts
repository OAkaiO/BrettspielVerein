export default defineAppConfig({
  ui: {
    colors: {
      primary: "primary",
      secondary: "secondary",
      tertiary: "tertiary",
      header: "header",
      footer: "footer",
    },
    input: {
      variants: {
        size: {
          xl: {
            base: "text-lg p-3",
          },
        },
      },
    },
  },
});
