function shortenDateAndTime(data: EventData) {
  data.start_time = data.start_time.substring(0, 5);
  const date = new Date(data.date);
  data.date = `${date.getDate()} ${date.toLocaleString("default", {
    month: "short",
  })}`;
}

export const repository = () => ({
  async getEventData(): Promise<EventData[]> {
    const promise: Promise<EventData[]> = $fetch<EventData[]>(
      "http://localhost/events.php"
    );
    return promise.then((data) => {
      data.forEach((item) => shortenDateAndTime(item));
      return data;
    });
  },
});
