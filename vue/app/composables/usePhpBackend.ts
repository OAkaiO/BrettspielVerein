export default function<TYPE> (url: string) {
  const { $api } = useNuxtApp();

  return {
    get: () => $api(url) as Promise<TYPE[]>,
    post: (body: TYPE) => {
      let t: keyof TYPE;
      for (t in body) {
        if (typeof body[t] === "string") {
          // Because we check the type to be string, the assignment is fine
          // eslint-disable-next-line @typescript-eslint/no-explicit-any
          body[t] = (body[t] as string).trim() as any;
        }
      }
      return $api(url, { body: body as object, method: "POST" });
    },
  };
}
