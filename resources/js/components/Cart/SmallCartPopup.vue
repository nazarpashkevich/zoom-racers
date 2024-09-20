<template>
    <div class="absolute top-0 right-0 w-96 z-[1000]" v-show="cart?.count > 0">
        <div class="h-8 bg-transparent"></div>
        <div class="bg-white rounded-lg border divide-y overflow-y-auto max-h-[32rem]">
            <div class="px-8 py-2 flex text-gray-600 text-sm">
                <div>Total: <span class="font-semibold">{{ amount }}</span></div>
                <div class="ml-auto">Items: <span class="font-semibold">{{ cart.count }}</span></div>
            </div>
            <template v-for="item in cart.items" :key="`${item.type}.${item.productId}`">
                <SmallCartItem :item="item" @update:cart="updateCart"/>
            </template>
            <div class="flex py-2 justify-center gap-8">
                <Link :href="route('cart.index')">
                    <SecondaryButton>Go To Cart</SecondaryButton>
                </Link>
                <Link :href="route('order.index')">
                    <PrimaryButton>Checkout</PrimaryButton>
                </Link>
            </div>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import CartService from "@/services/CartService";
import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import SmallCartItem from "@/components/Cart/SmallCartItem.vue";
import { formatPrice } from "@/helpers/money";

export default defineComponent({
    name: "SmallCartPopup",
    components: { SmallCartItem, SecondaryButton, PrimaryButton, Link },
    computed: {
        amount() {
            return this.cart?.amount ? formatPrice(this.cart.amount) : '0';
        }
    },
    data: () => ({
        cart: {}
    }),
    methods: {
        formatPrice,
        async initItems(): void {
            this.cart = await this.service.cart();
        },
        updateCart(cart) {
            this.cart = cart;
        }
    },
    mounted() {
        this.initItems();
    },
    async setup() {
        const service = CartService.make();
        return { service };
    }
})
</script>
