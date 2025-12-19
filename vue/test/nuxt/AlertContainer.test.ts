import { describe, it, expect } from "vitest";
import { mountSuspended } from "@nuxt/test-utils/runtime";
import { AlertContainer, UAlert } from "#components";

describe("AlertContainer", () => {
  it("shows no alerts when no data passed", async () => {
    const component = await mountSuspended(AlertContainer, {
      props: {
        alertData: [],
      },
    });

    const alerts = component.findAllComponents(UAlert);
    expect(alerts.length).toBe(0);
  });

  it("shows one alert per passed alertData", async () => {
    const component = await mountSuspended(AlertContainer, {
      props: {
        alertData: [
          {
            message: "Hello There 1",
            type: "success",
          },
          {
            message: "Hello There 2",
            type: "warning",
          },
          {
            message: "Hello There 3",
            type: "info",
          },
          {
            message: "Hello There 4",
            type: "error",
          },
        ],
      },
    });

    const alerts = component.findAllComponents(UAlert);
    expect(alerts.length).toBe(4);

    expect(alerts[0]!.props().title).toBe("Hello There 1");
    expect(alerts[0]!.props().color).toBe("success");

    expect(alerts[1]!.props().title).toBe("Hello There 2");
    expect(alerts[1]!.props().color).toBe("warning");

    expect(alerts[2]!.props().title).toBe("Hello There 3");
    expect(alerts[2]!.props().color).toBe("info");

    expect(alerts[3]!.props().title).toBe("Hello There 4");
    expect(alerts[3]!.props().color).toBe("error");
  });
});
