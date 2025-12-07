import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { BVZSheet, ImageContainer, WaveVariant1, WaveVariant2 } from "#components";

describe("ImageContainer", () => {
  it("only displays right sheet if content passed", async () => {
    const component = await mountSuspended(ImageContainer, {
      props: {
        variant: 1,
      },
      slots: {
        default: "Hello World",
      },
    });

    const sheets = component.findAllComponents(BVZSheet);
    expect(sheets.length).toBe(1);
    expect(sheets[0]!.text()).toBe("Hello World");
  });

  it("displays right sheet if content passed", async () => {
    const component = await mountSuspended(ImageContainer, {
      props: {
        variant: 1,
      },
      slots: {
        default: "Hello World",
        right: "Hello Again",
      },
    });

    const sheets = component.findAllComponents(BVZSheet);
    expect(sheets.length).toBe(2);
    expect(sheets[0]!.text()).toBe("Hello World");
    expect(sheets[1]!.text()).toBe("Hello Again");
  });

  describe("variant 1", () => {
    it("uses image 1 for variant 1", async () => {
      const component = await mountSuspended(ImageContainer, {
        props: {
          variant: 1,
        },
      });

      expect(component.find("div").classes("img1")).toBe(true);
    });

    it("uses wave variant 1", async () => {
      const component = await mountSuspended(ImageContainer, {
        props: {
          variant: 1,
        },
      });

      const waves = component.findAllComponents(WaveVariant1);
      expect(waves.length).toBe(2);

      expect(waves[0]!.props().color).toBe("--ui-header");
      expect(waves[0]!.props().lower).toBe(false);

      expect(waves[1]!.props().color).toBe("--ui-bg");
      expect(waves[1]!.props().lower).toBe(true);
    });
  });

  describe("variant 2", () => {
    it("uses image 2 for variant 2", async () => {
      const component = await mountSuspended(ImageContainer, {
        props: {
          variant: 2,
        },
      });

      expect(component.find("div").classes("img2")).toBe(true);
    });

    it("uses wave variant 2", async () => {
      const component = await mountSuspended(ImageContainer, {
        props: {
          variant: 2,
        },
      });

      const waves = component.findAllComponents(WaveVariant2);
      expect(waves.length).toBe(2);

      expect(waves[0]!.props().color).toBe("--ui-bg");
      expect(waves[0]!.props().lower).toBe(false);

      expect(waves[1]!.props().color).toBe("--ui-bg");
      expect(waves[1]!.props().lower).toBe(true);
    });
  });
});
