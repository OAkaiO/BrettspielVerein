function buildAndAppendEventBox(eventInfo, idPostfix) {

    const dateDay = eventInfo.day;
    const dateMonth = eventInfo.month;
    const name = eventInfo.name;
    const location = eventInfo.location;
    const time = eventInfo.time;
    const price = eventInfo.price;

    const template = document.querySelector("#eventTemplate");
    const clone = template.content.cloneNode(true);

    const dayField = clone.querySelector("#t_event_day");
    dayField.textContent = dateDay;
    dayField.id = `event_day_${idPostfix}`;

    const monthField = clone.querySelector("#t_event_month");
    monthField.textContent = dateMonth;
    monthField.id = `event_month_${idPostfix}`;

    const nameField = clone.querySelector("#t_event_name");
    nameField.textContent = name;
    nameField.id = `event_day_${idPostfix}`;

    const locationField = clone.querySelector("#t_event_location");
    locationField.textContent = location;
    locationField.id = `event_location_${idPostfix}`;

    const timeField = clone.querySelector("#t_event_time");
    timeField.textContent = time;
    timeField.id = `event_time_${idPostfix}`;

    const prcieField = clone.querySelector("#t_event_price");
    prcieField.textContent = price;
    prcieField.id = `event_prcie_${idPostfix}`;

    const events = document.querySelector("#events_container");

    events.appendChild(clone);
}

function getEvents() {
    const currentEpoch = Math.floor(Date.now() / 1000)
    $.get("events.php").done(data => {
        let builtEntries = 0;
        for (const month of data) {
            if (currentEpoch > month.epoch) {
                // skip past events
                continue;
            } else {
                buildAndAppendEventBox(month, builtEntries)
                builtEntries++
            }
            if (builtEntries > 2) {
                break
            }
        }
    }).fail("Something went wrong when fetching the events data!");
}

getEvents();