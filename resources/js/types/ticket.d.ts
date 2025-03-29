import { EventModel } from '@/types/event';

export interface Ticket {
  id: number | null;
  event: EventModel;
  reference: string;
  isCanceled: boolean;
  ticketPath: string;
}
