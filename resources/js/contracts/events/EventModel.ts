import Price from "@/contracts/common/Price";
import DictionaribleEnum from "@/contracts/common/DictionaribleEnum";

export default interface EventModel {
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
