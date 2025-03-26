import ApiClient from "@/api/api.client";
import { CartItem } from "@/types/cart";

class CartService {
    constructor(protected client: ApiClient) {
    }

    public async update(item: CartItem): Promise<CartItem[]> {
        return (await this.client.put(route(`cart.update`), item)).data.data;
    }

    public async remove(item: CartItem): Promise<CartItem[]> {
        return (await this.client.delete(route(`cart.delete`), { data: item })).data.data;
    }

    public clear(): Promise<object[]> {
    }

    public async cart(): Promise<CartItem[]> {
        return (await this.client.get(route(`cart.list`))).data.data;
    }
}

export default new CartService(ApiClient);
