export default function<TYPE> (url: string) {
  const { $api } = useNuxtApp();

  return {
    get: () => $api(url),
    post: (body: object) => $api(url, { body, method: "POST" }),
  };
}
