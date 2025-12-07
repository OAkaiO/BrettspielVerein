import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { BVZSheet } from "#components";

describe("BVZSheet", () => {
  it("displays contents in slot", async () => {
    const component = await mountSuspended(BVZSheet, {
      slots: {
        default: "This is a test",
      },
    });

    expect(component.find("div").text()).toContain("This is a test");
  });
});
