import { CartProductTypeEnum } from '@/enums/cart-product-type.enum';
import { CartItem } from '@/types/cart';

export function productableDomain(product: CartItem): string {
  switch (product.type) {
    case CartProductTypeEnum.Event:
      return 'events';
    case CartProductTypeEnum.Product:
      return 'products';
  }

  throw Error('Unknown productable type!');
}
