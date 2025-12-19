import * as z from "zod";

export default function (target: string) {
  const validationString = `Bitte ${target} angeben`;
  return z.string(validationString).trim().min(1, validationString);
}
