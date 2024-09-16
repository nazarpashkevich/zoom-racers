<template>
    <div class="absolute top-0 right-0 w-96 z-[1000]" v-show="cart?.count > 0">
        <div class="h-8 bg-transparent"></div>
        <div class="bg-white rounded-lg border divide-y overflow-y-auto max-h-[32rem]">
            <div class="px-8 py-2 flex text-gray-600 text-sm">
                <div>Total: <span class="font-semibold">{{ cart?.amount ? formatPrice(cart.amount) : '0' }}</span></div>
                <div class="ml-auto">Items: <span class="font-semibold">{{ cart.count }}</span></div>
            </div>
            <template v-for="item in cart.items" :key="`${item.type}.${item.productId}`">
                <Link
                    class="px-4 py-4 flex gap-6 cursor-pointer hover:bg-gray-50"
                    :href="route(`${productableDomain(item)}.show`, item.productId)">
                    <div class="w-12 h-12 rounded-md bg-cover bg-center"
                         :style="{backgroundImage: `url('${item.productable.picture}')`}"></div>
                    <div>
                        <div class="text-sm font-semibold">{{ makeTitle(item.productable.title) }}</div>
                        <div class="text-xs mt-2">{{ formatPrice(item.productable.price) }}</div>
                    </div>
                    <div class="ml-auto my-auto">
                        <ControlNumberInput
                            :model-value="item.quantity"
                            @update:model-value="e => updateQuantity(item, e)"
                        />
                    </div>

                    <div class="cursor-pointer">
                        <TrashIcon class="w-3.5 h-3.5 fill-red-700" @click.prevent="deleteItem(item)"/>
                    </div>
                </Link>
            </template>
            <div class="flex py-2 justify-center gap-8">
                <Link :href="route('cart.index')">
                    <SecondaryButton>Show Cart</SecondaryButton>
                </Link>
                <Link :href="route('cart.index')">
                    <PrimaryButton>Checkout</PrimaryButton>
                </Link>
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import CartService from "@/services/CartService";
import TrashIcon from "@/components/Icons/TrashIcon.vue";
import ControlNumberInput from "@/components/Form/ControlNumberInput.vue";
import CartItem from "@/contracts/cart/CartItem";
import { Link } from "@inertiajs/vue3";
import { formatPrice } from "@/helpers/money";
import { productableDomain } from "@/helpers/cart";
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";

export default defineComponent({
    name: "SmallCartPopup",
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
        },
        async deleteItem(item: CartItem): void {
            const cart = await this.service.remove(item);
            this.$page.props.cart = cart;
            this.cart = cart;
        },
        async initItems(): void {
            this.cart = await this.service.cart();
        },
    },
    data: () => ({
        cart: {}
    }),
    mounted() {
        this.initItems();
    },
    async setup() {
        const service = CartService.make();
        return { service };
    }
})
</script>
