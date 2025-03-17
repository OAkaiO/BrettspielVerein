export default function (): {
  headers: Ref<HeaderSpec[]>;
  receiver: HeaderReceiver;
} {
  const headers: Ref<HeaderSpec[]> = ref([]);
  const receiver = (getter: ComputedRef<HeaderSpec[]>) => {
    onMounted(() => {
      headers.value = getter.value;
    });
    onUnmounted(() => {
      headers.value = [];
    });
  };
  return { headers, receiver };
}
