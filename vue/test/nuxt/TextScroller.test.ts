import { describe, it, expect, vi } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { TextScroller } from "#components";

describe("TextScroller", () => {
  it("shows first element on intial render", async () => {
    const scroller = await mountSuspended(TextScroller, {
      props: {
        items: ["This is the first text", "This is the second item"],
      },
    });

    expect(scroller.findComponent("#rotator").text()).toBe("This is the first text");
  });

  it("shows second element after duration expired and rolls over to first", async () => {
    vi.useFakeTimers();
    const scroller = await mountSuspended(TextScroller, {
      props: {
        items: ["This is the first text", "This is the second text"],
        duration: 4000,
      },
    });

    await vi.advanceTimersByTimeAsync(5000);
    expect(scroller.findComponent("#rotator").text()).toBe("This is the second text");

    await vi.advanceTimersByTimeAsync(4000);
    expect(scroller.findComponent("#rotator").text()).toBe("This is the first text");
  });
});
