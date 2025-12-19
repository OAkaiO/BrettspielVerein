import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { setVueLeafletConfig } from "@maxel01/vue-leaflet";
import Index from "../../app/pages/index.vue";

// This and the setting of global below are workarounds. Without them, there
// are package export errors
setVueLeafletConfig({
  experimental: {
    useResetWebpackIcon: false,
  },
});

global.ResizeObserver = class ResizeObserver {
  observe() {}
  unobserve() {}
  disconnect() {}
};

describe("index", () => {
  it("emits event with scroll information", async () => {
    const component = await mountSuspended(Index);

    const emitted = component.emitted("provideNavigation");
    expect(emitted).toHaveLength(1);
    expect(emitted![0]![0]).toHaveLength(5);
    expect((emitted![0]![0]! as HeaderSpec[]).map(i => i.displayName)).toEqual([
      "Home",
      "Über uns",
      "Mitgliedschaft",
      "Events",
      "Kontakt",
    ]);
    expect((emitted![0]![0]! as HeaderSpec[])![0]!.scrolledBeginningToTop.value).toBe(true);
  });
});
