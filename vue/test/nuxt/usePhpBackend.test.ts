import { describe, it, expect, vi } from "vitest";
import { mockNuxtImport } from "@nuxt/test-utils/runtime";

const { useNuxtAppMock, mockApi } = vi.hoisted(() => {
  const mockApi = vi.fn((_: string, __ = {}) => Promise.resolve());
  return {
    useNuxtAppMock: vi.fn((_) => {
      return {
        $api: mockApi,
      };
    }),
    mockApi,
  };
});

mockNuxtImport("useNuxtApp", () => {
  return useNuxtAppMock;
});

describe("usePhpBackend", () => {
  describe("get", () => {
    it("calls api directly with provided url", () => {
      const { get } = usePhpBackend("dummy.php");
      get();

      expect(mockApi).toBeCalledWith("dummy.php");
    });
  });

  describe("post", () => {
    it("calls api at provided url, with provided body, as a POST", () => {
      const { post } = usePhpBackend("dummy.php");
      const body = { a: "Unit", b: 4 };
      post(body);

      expect(mockApi).toBeCalledWith("dummy.php", {
        body,
        method: "POST",
      });
    });

    it("trims all strings", () => {
      const { post } = usePhpBackend("dummy.php");
      const body = { a: "    Unit   test  ", b: 4, c: "Another test     ", d: "   " };
      post(body);

      const expectedBody = { a: "Unit   test", b: 4, c: "Another test", d: "" };
      expect(mockApi).toBeCalledWith("dummy.php", {
        body: expectedBody,
        method: "POST",
      });
    });
  });
});
