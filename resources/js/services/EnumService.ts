import DictionaribleEnum from "@/contracts/common/DictionaribleEnum";
import ApiClient from "@/api/ApiClient";

export default class EnumService {
    constructor(protected client: ApiClient) {
    }

    public static make(): EnumService {
        return new EnumService(ApiClient.make());
    }

    public async requestEnum(domain: string, enumName: string): Promise<DictionaribleEnum[]> {
        return (await this.client.get(route(`${domain}.dictionary`, enumName))).data.data;
    }
}
