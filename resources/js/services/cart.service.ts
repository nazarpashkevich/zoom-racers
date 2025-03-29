import ApiClient from '@/api/api.client';
import { CartItem } from '@/types/cart';

class CartService {
    public update(item: CartItem): Promise<CartItem[]> {
        return ApiClient.put(route(`cart.update`), item)
            .then(res => res.data)
            .then(res => res.data);
    }

    public remove(item: CartItem): Promise<CartItem[]> {
        return ApiClient.delete(route(`cart.delete`), { data: item })
            .then(res => res.data)
            .then(res => res.data)
    }

    public clear(): Promise<object[]> {
    }

    public cart(): Promise<CartItem[]> {
        return ApiClient.get(route(`cart.list`))
            .then(res => res.data)
            .then(res => res.data);
    }
}

export default new CartService();
