export interface Currency {
    symbol: string,
    prefix: string,
}

export interface DictionaribleEnum {
    value: string,
    title: string
}

export interface Price {
    amount: number,
    value: number,
    currency: Record<string, Currency>,
}

export interface PaginationMeta {
    from: number,
    to: number,
    current_page: number,
    last_page: number,
    per_page: number,
    total: number,
    path: string,
    pageName: string,
}

export interface BaseData<T> {
    data: T[],
    meta: PaginationMeta
}
