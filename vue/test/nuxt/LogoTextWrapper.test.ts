import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { LogoTextWrapper } from "#components";

describe("LogoTextWrapper", () => {
  it("has correct text", async () => {
    const component = await mountSuspended(LogoTextWrapper);
    expect(component.text()).toMatchInlineSnapshot("'Brettspielverein Zofingen'");
  });

  it("respects light setting", async () => {
    const component = await mountSuspended(LogoTextWrapper);

    expect(component.get("img").classes("invert")).toBe(false);
    expect(component.get("span").classes("text-black")).toBe(true);

    await component.setProps({ light: true });

    expect(component.get("img").classes("invert")).toBe(true);
    expect(component.get("span").classes("text-white")).toBe(true);
  });
});
