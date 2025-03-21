export default function (url: string) {
  const { $api } = useNuxtApp();

  return {
    get: () => $api(url),
    post: (body: object) => $api(url, { body, method: "POST" }),
  };
}
