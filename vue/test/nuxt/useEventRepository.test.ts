import { describe, it, expect, vi } from "vitest";
import { mockNuxtImport } from "@nuxt/test-utils/runtime";

const testEvent: EventData = {
  id: "1",
  date: "2025-12-12",
  location: "Spittelhof",
  name: "Brettspielabend",
  price: "5",
  start_time: "19:30:00",
};

const { usePhpBackendMock } = vi.hoisted(() => {
  return {
    usePhpBackendMock: vi.fn((_) => {
      return {
        get: () => Promise.resolve([testEvent]),
        post: (_: object) => Promise.resolve(),
      };
    }),
  };
});

mockNuxtImport("usePhpBackend", () => {
  return usePhpBackendMock;
});

describe("useEventRepository", () => {
  it("calls usePhpBackend for 'events'", () => {
    useEventRepository();

    expect(usePhpBackendMock).toBeCalledWith("/events");
  });

  it("returns data from php backend with adjusted date and time", async () => {
    const { repository } = useEventRepository();
    const data = await repository.getEventData();

    expect(data.length).toBe(1);
    expect(data[0]!.start_time).toBe("19:30");
    expect(data[0]!.date).toBe("12. Dez. 2025");
  });
});
