import { Price } from '@/types/common';
import { Cart } from '@/types/cart';

export interface UserOrder {
  cart: Cart;
  details: UserOrderDetails;
  shipping?: Price;
  total?: Price;
}

export interface UserOrderDetails {
  name: string;
  email: string;
  address: string;
}
