import Price from "@/contracts/common/Price";
import CartItem from "@/contracts/cart/CartItem";

export default interface Cart {
    amount: Price;
    count: number,
    items: CartItem[]
}
