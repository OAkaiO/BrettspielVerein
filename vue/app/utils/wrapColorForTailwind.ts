export default function (color: string) {
  if (color.startsWith("--")) {
    return `var(${color})`;
  }
  else if (color.startsWith("#")) {
    return `[${color}]`;
  }
  else {
    return color;
  }
}
