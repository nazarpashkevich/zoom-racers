import EventModel from "@/contracts/events/EventModel";
import dayjs from "dayjs";

export default class EventResource {
    constructor(protected event: EventModel) {
    }

    public price(): string {
        const currency = this.event.price.currency[Object.keys(this.event.price.currency)[0]].symbol;
        return `${currency} ${this.event.price.value}`;
    }

    public date(): string {
        const start = dayjs(this.event.start);
        const end = dayjs(this.event.end);

        if (start.isSame(end, 'day')) { // the same day
            return `${start.format('DD MMM HH:ss')} - ${end.format('HH:ss')}`;
        }

        return `${start.format('DD MMM HH:ss')} - ${end.format('DD MMM HH:ss')}`;
    }
}
