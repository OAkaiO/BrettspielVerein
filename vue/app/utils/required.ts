export default function (value: string) {
  if (value && value.trim().length > 0) {
    return true;
  } else {
    return "Dieses Feld ist erforderlich";
  }
}
