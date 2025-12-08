import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { Section } from "#components";

describe("Section", () => {
  it("displays contents in slot", async () => {
    const component = await mountSuspended(Section, {
      props: {
        title: "This is a title",
      },
      slots: {
        default: "<span>This is a test</span>",
      },
    });

    expect(component.find("h1").text()).toContain("This is a title");
    expect(component.find("span").text()).toContain("This is a test");
  });
});
