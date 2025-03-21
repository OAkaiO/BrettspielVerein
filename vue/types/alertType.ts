export type AlertType = "success" | "warning" | "info" | "error" | undefined
export type AlertStatus = {
  message: string;
  type: AlertType;
};