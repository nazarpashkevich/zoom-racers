import Price from "@/contracts/common/Price";
import Cart from "@/contracts/cart/Cart";
import UserOrderDetails from "@/contracts/order/UserOrderDetails";

export default interface UserOrder {
    cart: Cart;
    details: UserOrderDetails;
    shipping?: Price,
    total?: Price,
}
