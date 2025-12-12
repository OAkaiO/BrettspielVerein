import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { EventDetails } from "#components";

describe("EventDetails", () => {
  it("displays all data and formats price", async () => {
    const wrapper = await mountSuspended(EventDetails, {
      props: {
        data: {
          id: "1",
          date: "2025-05-14",
          location: "Spittelhof",
          price: "5",
          start_time: "19:30",
          name: "Test Event",
        },
      },
    });

    const tableRows = wrapper.findAll("tr");
    expect(tableRows.length).toBe(3);

    expect(tableRows[0]!.text()).toBe("Ort:Spittelhof");
    expect(tableRows[1]!.text()).toBe("Zeit:19:30");
    expect(tableRows[2]!.text()).toBe("Eintritt:5.-");
  });

  it("displays a dash when price is not a number", async () => {
    const wrapper = await mountSuspended(EventDetails, {
      props: {
        data: {
          id: "1",
          date: "2025-05-14",
          location: "Spittelhof",
          price: "Not a number",
          start_time: "19:30",
          name: "Test Event",
        },
      },
    });

    const tableRows = wrapper.findAll("tr");
    expect(tableRows.length).toBe(3);

    expect(tableRows[0]!.text()).toBe("Ort:Spittelhof");
    expect(tableRows[1]!.text()).toBe("Zeit:19:30");
    expect(tableRows[2]!.text()).toBe("Eintritt:-");
  });
});
