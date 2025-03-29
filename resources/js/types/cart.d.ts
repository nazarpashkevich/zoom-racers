import { Price } from '@/types/common';
import { CartProductTypeEnum } from '@/enums/cart-product-type.enum';

export interface Cart {
  amount: Price;
  count: number;
  items: CartItem[];
}

export interface CartItem {
  productId: string;
  type: CartProductTypeEnum;
  quantity: number;
  amount?: Price;
  productable: ?{
    title: string;
    picture: string;
    price: Price;
  };
}
