function buildAndAppendEventBox(eventInfo) {

    const date = new Date(eventInfo.date);
    const dateDay = date.getDate();
    const dateMonth = date.toLocaleString('default', { month: 'short' });
    const dateYear = date.getFullYear();
    const name = eventInfo.name;
    const location = eventInfo.location;
    const time = eventInfo.start_time.substring(0, 5);
    const price = eventInfo.price;

    const template = document.querySelector("#eventTemplate");
    const clone = template.content.cloneNode(true);

    const dayField = clone.querySelector("#t_event_day");
    dayField.textContent = dateDay;
    dayField.id = `event_day_${eventInfo}`;

    const monthField = clone.querySelector("#t_event_month");
    monthField.textContent = `${dateMonth} ${dateYear}`;
    monthField.id = `event_month_${eventInfo}`;

    const nameField = clone.querySelector("#t_event_name");
    nameField.textContent = name;
    nameField.id = `event_day_${eventInfo}`;

    const locationField = clone.querySelector("#t_event_location");
    locationField.textContent = location;
    locationField.id = `event_location_${eventInfo}`;

    const timeField = clone.querySelector("#t_event_time");
    timeField.textContent = time;
    timeField.id = `event_time_${eventInfo}`;

    const prcieField = clone.querySelector("#t_event_price");
    prcieField.textContent = `${price}.-`;
    prcieField.id = `event_prcie_${eventInfo}`;

    const events = document.querySelector("#events_container");

    events.appendChild(clone);
}

function getEvents() {
    $.get("events.php").done(data => {
        for (const month of data) {
            buildAndAppendEventBox(month);
        }
    }).fail("Something went wrong when fetching the events data!");
}

getEvents();