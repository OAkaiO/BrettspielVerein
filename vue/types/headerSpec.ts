type ScrollGoal = {
  ref: Ref<string | number | HTMLElement | ComponentPublicInstance | null>;
  isScrolledOver: () => boolean;
};
export type HeaderSpec = {
  displayName: string;
  goal: ScrollGoal;
};
