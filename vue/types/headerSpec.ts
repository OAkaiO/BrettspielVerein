type ScrollGoal = {
  ref: HTMLElement | ComponentPublicInstance | null;
  isScrolledOver: () => boolean;
};
export type HeaderSpec = {
  displayName: string;
  goal: ScrollGoal;
};
