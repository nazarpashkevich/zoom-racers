<template>
    <div class="text-slate-700 text-xl font-semibold mb-6">
        Your order:
    </div>
    <div class="mb-6">
        <template v-for="item in order.cart.items">
            <SmallCartItem :item="item"/>
        </template>
    </div>
    <div class="py-4 px-4 flex flex-col gap-2 text-slate-600">
        <span class="text-sm">
            SubTotal: <span class="font-semibold text-black float-right">
            {{ formatPrice(order.cart.amount) }}
        </span>
        </span>
        <span class="text-sm mb-2">
            Delivery: <span class="font-semibold text-black float-right">
            {{ order.shipping ? formatPrice(order.shipping) : 'Not calculated' }}
        </span>
        </span>
        <span class="text-xl">
            Total: <span class="font-semibold text-black float-right">
            {{ order.total ? formatPrice(order.total) : 'Not calculated' }}
        </span>
        </span>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import { formatPrice } from "@/helpers/money";
import SmallCartItem from "@/components/Cart/SmallCartItem.vue";
import { Order } from "@stripe/stripe-js";

export default defineComponent({
    name: "OrderTotal",
    methods: { formatPrice },
    components: { SmallCartItem },
    props: {
        order: {
            type: Object as Order,
            required: true
        }
    }
})
</script>
