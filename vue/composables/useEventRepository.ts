function shortenDateAndTime(data: EventData) {
  data.start_time = data.start_time.substring(0, 5);
  const date = new Date(data.date);
  data.date = `${date.getDate()} ${date.toLocaleString("default", {
    month: "short",
  })}`;
}

export default function () {
  const { get } = usePhpBackend('/events.php')

  return {
    repository: {
      async getEventData(): Promise<EventData[]> {
        const promise: Promise<EventData[]> = get() as Promise<EventData[]>;
        return promise.then((data) => {
          data.forEach((item) => shortenDateAndTime(item));
          return data;
        });
      },
    },
  };
}
