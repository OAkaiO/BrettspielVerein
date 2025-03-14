export default function (): {
  headers: Ref<HeaderSpec[]>;
  registrator: HeaderReigstrator;
} {
  const headers: Ref<HeaderSpec[]> = ref([]);
  const registrator = (getter: () => HeaderSpec[]) => {
    onMounted(() => (headers.value = getter()));
    onUnmounted(() => (headers.value = []));
  };
  return { headers, registrator };
}
