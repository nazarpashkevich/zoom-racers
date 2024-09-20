<template>
    <PrimaryButton @click="router().visit(route('order.index'))">
        <span class="w-full text-center">Checkout</span>
    </PrimaryButton>
    <SecondaryButton @click="router().visit(route('cart.clear'))">
        <span class="w-full text-center">Clear</span>
    </SecondaryButton>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import { Link, router } from "@inertiajs/vue3";

export default defineComponent({
    name: "CartActions",
    methods: {
        router() {
            return router
        }
    },
    components: { SecondaryButton, PrimaryButton, Link }
})
</script>
