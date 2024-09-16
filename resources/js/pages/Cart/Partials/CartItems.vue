<template>
    <div v-if="items?.length === 0" class="flex h-full items-center justify-center text-slate-500">
        No items here yet :(
    </div>
    <div v-else class="divide-y">
        <template v-for="(item, index) in items" :key="index">
            <Link
                class="px-4 py-4 flex gap-6 cursor-pointer hover:bg-gray-50"
                :href="route(`${productableDomain(item)}.show`, item.productId)">
                <div class="w-24 h-24 rounded-md bg-cover bg-center"
                     :style="{backgroundImage: `url('${item.productable.picture}')`}"></div>
                <div class="flex flex-col">
                    <div class="text-xl font-semibold">{{ item.productable.title }}</div>
                    <div class="text-md mt-2 font-semibold">{{ formatPrice(item.amount) }}</div>
                    <div class="mt-auto flex gap-12 text-slate-600 text-xs">
                        <div>Price: <span class="font-semibold">{{ formatPrice(item.productable.price) }}</span></div>
                        <div>Quantity: <span class="font-semibold">{{ item.quantity }}</span></div>
                    </div>
                </div>
                <div class="ml-auto my-auto mr-12">
                    <ControlNumberInput
                        :model-value="item.quantity"
                        @update:model-value="e => updateQuantity(item, e)"
                    />
                </div>

                <div class="cursor-pointer my-auto">
                    <TrashIcon class="w-3.5 h-3.5 fill-red-700" @click.prevent="deleteItem(item)"/>
                </div>
            </Link>
        </template>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import CartItem from "@/contracts/cart/CartItem";
import { Link, router } from "@inertiajs/vue3";
import ControlNumberInput from "@/components/Form/ControlNumberInput.vue";
import TrashIcon from "@/components/Icons/TrashIcon.vue";
import { productableDomain } from "@/helpers/cart";
import { formatPrice } from "@/helpers/money";
import CartService from "@/services/CartService";

export default defineComponent({
    name: "CartItems",
    methods: {
        formatPrice,
        productableDomain,
        async updateQuantity(item: CartItem, quantity: number): void {
            item.quantity = quantity;
            await this.service.update(item);
            router.reload();
        },
        async deleteItem(item: CartItem): void {
            await this.service.remove(item);
            router.reload();
        },
    },
    components: { TrashIcon, ControlNumberInput, Link },
    props: {
        items: {
            type: Array as CartItem[],
            required: true
        }
    },
    setup() {
        const service = CartService.make();
        return { service };
    }
})
</script>
