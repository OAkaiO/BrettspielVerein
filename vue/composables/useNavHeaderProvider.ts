type HeaderInfo = {
  displayName: string;
  ref: Ref<HTMLElement | ComponentPublicInstance | null>;
  scrollState: Ref<boolean>;
};

export default function (receiver: HeaderReceiver) {
  const titledRefs: Ref<HeaderInfo[]> = ref([]);

  const { arrivedState } = useWindowScroll();
  const atBottom = computed(() => arrivedState.bottom);

  function addAHeader(
    displayName: string,
    ref: Ref<HTMLElement | ComponentPublicInstance | null>
  ) {
    const { top } = useElementBounding(ref);
    const scrollState = computed(() => !!ref.value && top.value < 51);
    titledRefs.value.push({ displayName, ref, scrollState });
  }

  const headerSpecs: ComputedRef<HeaderSpec[]> = computed(() => {
    return titledRefs.value.map((element, index) => {
      return {
        displayName: element.displayName,
        goal: {
          ref: element.ref,
          isScrolledOver: computed(
            () =>
              index === 0 ||
              element.scrollState ||
              (index === titledRefs.value.length - 1 && atBottom.value)
          ) as ComputedRef<boolean>,
        },
      };
    });
  });

  receiver(headerSpecs);
  return { addAHeader, atBottom };
}
