import Price from "@/contracts/common/Price";

export function formatPrice(price: Price): string {
    return new Intl.NumberFormat(navigator.language, { style: 'currency', currency: Object.keys(price.currency)[0] })
        .format(price.amount / 100);
}
