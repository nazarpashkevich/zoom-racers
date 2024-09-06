import Currency from "@/contracts/common/Currency";

export default interface Price {
    amount: number,
    value: number,
    currency: Record<string, Currency>,
}
