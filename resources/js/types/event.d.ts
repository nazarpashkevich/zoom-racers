import { DictionaribleEnum, Price } from "@/types/common";

export interface EventModel {
    id: number | null,
    title: string,
    picture: string | File,
    description: string,
    category: DictionaribleEnum,
    language: DictionaribleEnum,
    platform: DictionaribleEnum,
    link: string,
    start: Date,
    end: Date,
    price: Price,
}
