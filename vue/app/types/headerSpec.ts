type ScrollGoal = {
  ref: Ref<HTMLElement | ComponentPublicInstance | null>;
  isScrolledOver: ComputedRef<boolean>;
};
export type HeaderSpec = {
  displayName: string;
  goal: ScrollGoal;
};
