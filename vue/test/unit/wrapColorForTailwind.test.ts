import { describe, it, expect } from "vitest";
import wrapColorForTailwind from "../../app/utils/wrapColorForTailwind";

describe("wrapColorVar", () => {
  it("passes given colors as is", () => {
    expect(wrapColorForTailwind("red")).toBe("red");
  });

  it("passes variables with parentheses", () => {
    expect(wrapColorForTailwind("--ui-background")).toBe("var(--ui-background)");
  });

  it("passes values with brackets", () => {
    expect(wrapColorForTailwind("#123456")).toBe("[#123456]");
  });
});
