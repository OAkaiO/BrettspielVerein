export default function () {
  const alertData = ref<AlertStatus[]>([]);

  function triggerAlert(status: AlertStatus) {
    alertData.value.unshift(status);
    setTimeout(() => {
      alertData.value.pop();
    }, 5000);
  }

  return { alertData, triggerAlert };
}
