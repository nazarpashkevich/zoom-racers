<template>
    <Link
        class="px-4 py-4 flex gap-4 cursor-pointer hover:bg-gray-50 hover:text-indigo-900"
        :href="route(`${productableDomain(item)}.show`, item.productId)">
        <div class="w-12 h-12 rounded-md bg-cover bg-center"
             :style="{backgroundImage: `url('${item.productable.picture}')`}"></div>
        <div>
            <div class="text-sm font-semibold">{{ makeTitle(item.productable.title) }}</div>
            <div class="text-xs mt-2">{{ formatPrice(item.productable.price) }}</div>
        </div>
        <div class="ml-auto my-auto mr-2">
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
<script lang="ts">
import { defineComponent } from 'vue'
import TrashIcon from "@/components/Icons/TrashIcon.vue";
import ControlNumberInput from "@/components/Form/ControlNumberInput.vue";
import CartItem from "@/contracts/cart/CartItem";
import { Link } from "@inertiajs/vue3";
import { formatPrice } from "@/helpers/money";
import { productableDomain } from "@/helpers/cart";
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import CartService from "@/services/CartService";

export default defineComponent({
    name: "SmallCartItem",
    components: { SecondaryButton, PrimaryButton, ControlNumberInput, TrashIcon, Link },
    methods: {
        productableDomain,
        formatPrice,
        makeTitle(text): string {
            return text.length > 13 ? text.substring(0, 13) + '...' : text;
        },
        async updateQuantity(item: CartItem, quantity: number): void {
            item.quantity = quantity;
            this.cart = await this.service.update(item);

            this.$emit('update:cart', this.cart);
        },
        async deleteItem(item: CartItem): void {
            this.cart = await this.service.remove(item);
            
            this.$emit('update:cart', this.cart);
        },
    },
    emits: ['update:cart'],
    props: {
        item: {
            type: Object as CartItem,
            required: true
        }
    },
    setup() {
        const service = CartService.make();
        return { service };
    }
})
</script>
