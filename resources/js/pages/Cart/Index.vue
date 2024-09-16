<template>
    <Head title="Cart"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex divide-x">
                    <div class="flex-[3] px-12 py-8 gap-12">
                        <CartItems :items="cart.items"/>
                    </div>
                    <div class="flex-1 py-8">
                        <div class="flex flex-col gap-4 w-full px-12 my-4">
                            <CartTotal class="text-center mb-8" :amount="cart.amount"/>
                            <CartActions v-if="cart?.count > 0"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CartItem from "@/contracts/cart/CartItem";
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import SmallCartPopup from "@/components/Cart/SmallCartPopup.vue";
import CartActions from "@/pages/Cart/Partials/CartActions.vue";
import CartItems from "@/pages/Cart/Partials/CartItems.vue";
import Cart from "@/contracts/cart/Cart";
import CartTotal from "@/pages/Cart/Partials/CartTotal.vue";

export default defineComponent({
    components: {
        CartTotal,
        CartItems,
        CartActions,
        SmallCartPopup,
        SecondaryButton,
        PrimaryButton,
        AuthenticatedLayout,
        Head
    },
    data: () => ({}),
    props: {
        cart: {
            type: Object as Cart,
            required: true
        }
    }
});
</script>
