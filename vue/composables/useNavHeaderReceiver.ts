export default function (): {
  headers: Ref<HeaderSpec[]>;
  receiver: HeaderReceiver;
} {
  const headers: Ref<HeaderSpec[]> = ref([]);
  const receiver = (getter : () => HeaderSpec[]) => {
    onMounted(() => (headers.value = getter()));
    onUnmounted(() => (headers.value = []));
  };
  return { headers, receiver };
}
