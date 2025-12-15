import { setup } from "@nuxt/test-utils/e2e";

const INTEGRATIONTEST_HOST = "http://localhost:8080";
const integrationTest = false;

export async function e2eSetup() {
  setup({
    host: integrationTest ? INTEGRATIONTEST_HOST : undefined,
  });
}
