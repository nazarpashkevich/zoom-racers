import ApiClient from '@/api/api.client';
import { DictionaribleEnum } from '@/types/common';

class EnumService {
  public async requestEnum(
    domain: string,
    enumName: string
  ): Promise<DictionaribleEnum[]> {
    return (await this.client.get(route(`${domain}.dictionary`, enumName))).data
      .data;
  }
}

export default new EnumService(ApiClient);
