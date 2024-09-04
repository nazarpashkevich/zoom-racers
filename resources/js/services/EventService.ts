import DictionaribleEnum from "@/contracts/DictionaribleEnum";
import EnumService from "@/services/EnumService";

export default class EventService {
    constructor(protected enumService: EnumService) {
    }

    public static make(): EventService {
        return new EventService(EnumService.make());
    }

    public languages(): Promise<DictionaribleEnum[]> {
        return this.enumService.requestEnum('events', 'language');
    }

    public categories(): Promise<DictionaribleEnum[]> {
        return this.enumService.requestEnum('events', 'category');
    }

    public platforms(): Promise<DictionaribleEnum[]> {
        return this.enumService.requestEnum('events', 'platform');
    }
}
