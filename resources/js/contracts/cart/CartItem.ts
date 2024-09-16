import { CartProductType } from "@/enums/CartProductType";
import Price from "@/contracts/common/Price";

export default interface CartItem {
    productId: string;
    type: CartProductType,
    quantity: number,
    amount?: Price,
    productable: ?{
        title: string;
        picture: string,
        price: Price,
    }
}
