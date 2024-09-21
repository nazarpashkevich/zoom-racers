import EventModel from "@/contracts/events/EventModel";

export default interface Ticket {
    id: number | null,
    event: EventModel,
    reference: string,
    isCanceled: boolean,
    ticketPath: string
}
