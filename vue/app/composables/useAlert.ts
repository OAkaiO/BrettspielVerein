export default function (displayDuration = 5000) {
  const alertData = ref<AlertStatus[]>([]);

  function triggerAlert(status: AlertStatus) {
    alertData.value.unshift(status);
    setTimeout(() => {
      alertData.value.pop();
    }, displayDuration);
  }

  return { alertData, triggerAlert };
}
