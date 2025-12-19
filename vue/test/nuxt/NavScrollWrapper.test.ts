import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { NavScrollWrapper } from "#components";

describe("NavScrollWrapper", () => {
  it("emits title and goto on mount", async () => {
    const wrapper = await mountSuspended(NavScrollWrapper, {
      props: {
        title: "Unit Test",
      },
      slots: {
        default: "<div>Hello There</div>",
      },
    });

    expect(wrapper.emitted("provideNavigation")?.length).toBe(1);
    expect(wrapper.emitted("provideNavigation")![0]![0]).toHaveProperty("goTo");
    expect(wrapper.emitted("provideNavigation")![0]![0]).toHaveProperty("displayName", "Unit Test");
  });
});
