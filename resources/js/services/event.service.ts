import EnumService from '@/services/enum.service';
import { DictionaribleEnum } from '@/types/common';

class EventService {
  public languages(): Promise<DictionaribleEnum[]> {
    return EnumService.requestEnum('events', 'language');
  }

  public categories(): Promise<DictionaribleEnum[]> {
    return EnumService.requestEnum('events', 'category');
  }

  public platforms(): Promise<DictionaribleEnum[]> {
    return EnumService.requestEnum('events', 'platform');
  }

  public priceRanges(): Promise<DictionaribleEnum[]> {
    return EnumService.requestEnum('events', 'price-range');
  }
}

export default new EventService();
