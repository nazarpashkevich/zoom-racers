<template>
    <SecondaryButton v-if="alreadyInCart" class="cursor-default" @click.prevent="() => null">
        <div class="flex gap-2 justify-center w-full">
            <BasketIcon class="fill-gray-800 w-4 h-4"/>
            Already in cart
        </div>
    </SecondaryButton>
    <PrimaryButton v-else @click.prevent="addToCartAction">
        <div class="flex gap-2 justify-center w-full">
            <BasketIcon class="fill-white w-4 h-4"/>
            Add to Card
        </div>
    </PrimaryButton>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import PrimaryButton from "@/components/PrimaryButton.vue";
import BasketIcon from "@/components/Icons/BasketIcon.vue";
import { CartProductType } from "@/enums/CartProductType";
import { useForm } from "@inertiajs/vue3";
import SecondaryButton from "@/components/SecondaryButton.vue";

export default defineComponent({
    name: "AddToCartButton",
    components: { SecondaryButton, BasketIcon, PrimaryButton },
    computed: {
        alreadyInCart() {
            return this.$page.props.cart.items.some(item => item.productId === this.productId);
        }
    },
    methods: {
        addToCartAction() {
            this.form.post(route('cart.create'), { preserveScroll: true });
        }
    },
    props: {
        type: {
            type: String as CartProductType,
            required: true
        },
        productId: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const form = useForm({
            type: props.type,
            productId: props.productId
        });

        return { form };
    }
})
</script>
