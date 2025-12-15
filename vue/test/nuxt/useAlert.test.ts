import { describe, it, expect, vi, beforeEach, afterEach } from "vitest";

describe("useAlert", () => {
  beforeEach(() => {
    vi.useFakeTimers();
  });

  afterEach(() => {
    vi.restoreAllMocks();
  });

  describe("adding alerts", () => {
    it("works", async () => {
      const { alertData, triggerAlert } = useAlert();

      const alert = { message: "Unit Test", type: "success" as AlertType };
      triggerAlert(alert);

      expect(alertData.value).toStrictEqual([alert]);
    });

    it("adds at the front of the structure", async () => {
      const { alertData, triggerAlert } = useAlert();

      const alert1 = { message: "Unit Test 1", type: "success" as AlertType };
      const alert2 = { message: "Unit Test 1", type: "success" as AlertType };
      triggerAlert(alert1);
      triggerAlert(alert2);

      expect(alertData.value).toStrictEqual([alert2, alert1]);
    });
  });

  describe("removing alerts", () => {
    it("uses default timeout of 5 seconds", () => {
      const { alertData, triggerAlert } = useAlert();

      const alert = { message: "Unit Test", type: "success" as AlertType };
      triggerAlert(alert);

      expect(alertData.value).toStrictEqual([alert]);

      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(0);
    });

    it("uses argument timeout if provided", () => {
      const { alertData, triggerAlert } = useAlert(2000);

      const alert = { message: "Unit Test", type: "success" as AlertType };
      triggerAlert(alert);

      expect(alertData.value).toStrictEqual([alert]);

      vi.advanceTimersByTime(2000);
      expect(alertData.value.length).toBe(0);
    });

    it("removes one at a time and from the back", () => {
      const { alertData, triggerAlert } = useAlert();

      const alert1 = { message: "Unit Test 1", type: "success" as AlertType };
      triggerAlert(alert1);

      expect(alertData.value).toStrictEqual([alert1]);

      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);

      const alert2 = { message: "Unit Test 1", type: "success" as AlertType };
      triggerAlert(alert2);
      expect(alertData.value).toStrictEqual([alert2, alert1]);

      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(2);
      vi.advanceTimersByTime(1000);
      expect(alertData.value.length).toBe(1);
      expect(alertData.value).toStrictEqual([alert2]);
    });
  });
});
