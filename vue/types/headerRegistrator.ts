export type HeaderReigstrator = (getter: () => {
    displayName: string;
    goal: {
      ref: HTMLElement | ComponentPublicInstance | null;
      isScrolledOver: () => boolean;
    }
  }[]) => void
