import { describe, it, expect } from "vitest";
import zodRequiredString from "../../app/utils/zodRequiredString";

describe("zodRequiredString", () => {
  it("uses passed target in error string", () => {
    const handler = zodRequiredString("Test");
    const parseResult = handler.safeParse(undefined);

    expect(parseResult.error).not.toBe({});
    const parsedMessage = JSON.parse(parseResult.error!.message);
    expect(parsedMessage[0].message).toBe("Bitte Test angeben");
  });

  it("fails on undefined", () => {
    const handler = zodRequiredString("Test");
    const parseResult = handler.safeParse(undefined);

    expect(parseResult.success).toBe(false);
  });

  it("fails on empty string", () => {
    const handler = zodRequiredString("Test");
    const parseResult = handler.safeParse("");

    expect(parseResult.success).toBe(false);
  });

  it("fails on whitespaces only", () => {
    const handler = zodRequiredString("Test");
    const parseResult = handler.safeParse("     ");

    expect(parseResult.success).toBe(false);
  });

  it("passes on not-empty string", () => {
    const handler = zodRequiredString("Test");
    const parseResult = handler.safeParse("Unit Test string");

    expect(parseResult.success).toBe(true);
  });
});
