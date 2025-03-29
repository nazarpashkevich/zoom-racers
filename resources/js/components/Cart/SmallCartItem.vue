<template>
    <Link
        :href="route(`${productableDomain(item)}.show`, item.productId)"
        class="px-4 py-4 flex gap-4 cursor-pointer hover:bg-gray-50 hover:text-indigo-900"
    >
        <div
            :style="{ backgroundImage: `url('${item.productable.picture}')` }"
            class="w-12 h-12 rounded-md bg-cover bg-center"
        ></div>
        <div>
            <div class="text-sm font-semibold">
                {{ makeTitle(item.productable.title) }}
            </div>
            <div class="text-xs mt-2">{{ formatPrice(item.productable.price) }}</div>
        </div>
        <div class="ml-auto my-auto mr-2">
            <ControlNumberInput
                :model-value="item.quantity"
                @update:model-value="(e) => updateQuantity(item, e)"
            />
        </div>

        <div class="cursor-pointer my-auto">
            <TrashIcon
                class="w-3.5 h-3.5 fill-red-700"
                @click.prevent="deleteItem(item)"
            />
        </div>
    </Link>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import TrashIcon from '@/components/Icons/TrashIcon.vue';
import ControlNumberInput from '@/components/Form/ControlNumberInput.vue';
import { Link } from '@inertiajs/vue3';
import { formatPrice } from '@/helpers/money.helpers';
import { productableDomain } from '@/helpers/cart.helpers';
import PrimaryButton from '@/components/PrimaryButton.vue';
import SecondaryButton from '@/components/SecondaryButton.vue';
import CartService from '@/services/cart.service';
import { CartItem } from '@/types/cart';

export default defineComponent({
    name: 'SmallCartItem',
    components: {
        SecondaryButton,
        PrimaryButton,
        ControlNumberInput,
        TrashIcon,
        Link,
    },
    methods: {
        productableDomain,
        formatPrice,
        makeTitle(text): string {
            return text.length > 13 ? text.substring(0, 13) + '...' : text;
        },
        async updateQuantity(item: CartItem, quantity: number): void {
            item.quantity = quantity;
            this.cart = await CartService.update(item);

            this.$emit('update:cart', this.cart);
        },
        async deleteItem(item: CartItem): void {
            this.cart = await CartService.remove(item);

            this.$emit('update:cart', this.cart);
        },
    },
    emits: ['update:cart'],
    props: {
        item: {
            type: Object as CartItem,
            required: true,
        },
    },
});
</script>
