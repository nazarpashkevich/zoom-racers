import CartItem from "@/contracts/cart/CartItem";
import { CartProductType } from "@/enums/CartProductType";

export function productableDomain(product: CartItem): string {
    switch (product.type) {
        case CartProductType.Event:
            return 'events'
        case CartProductType.Product:
            return 'products'
    }

    throw Error('Unknown productable type!');
}
