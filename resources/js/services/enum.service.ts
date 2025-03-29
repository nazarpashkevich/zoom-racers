import ApiClient from '@/api/api.client';
import { DictionaribleEnum } from '@/types/common';

class EnumService {
    public async requestEnum(
        domain: string,
        enumName: string
    ): Promise<DictionaribleEnum[]> {
        return ApiClient.get(route(`${domain}.dictionary`, enumName))
            .then(res => res.data)
            .then(res => res.data);
    }
}

export default new EnumService();
