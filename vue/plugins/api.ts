export default defineNuxtPlugin((nuxtApp) => {
  const runtimeConfig = useRuntimeConfig();

  const api = $fetch.create({
    baseURL: runtimeConfig.public.apiUrl,
  });

  return {
    provide: {
      api,
    },
  };
});
