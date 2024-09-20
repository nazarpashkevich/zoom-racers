<template>
    <div class="flex h-full" v-show="isLoading">
        <img class="m-auto w-12 h-12" src="/images/order/loader.gif" alt="">
    </div>
    <form class="pt-8" @submit.prevent="handleSubmit" v-show="!isLoading">
        <div id="link-authentication-element"/>
        <div id="payment-element" class="mb-6"/>
        <PrimaryButton class="float-right" v-show="!isLoading">Pay now</PrimaryButton>
    </form>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import { loadStripe } from "@stripe/stripe-js";
import { env } from "@/env";
import PrimaryButton from "@/components/PrimaryButton.vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";

export default defineComponent({
    name: "PaymentData",
    components: { PrimaryButton },
    data: () => ({
        isLoading: true,
        stripe: null,
        elements: null,
        reference: null
    }),
    props: {
        form: {
            type: Object,
            required: true
        }
    },
    methods: {
        async handleSubmit() {
            if (this.isLoading) {
                return;
            }

            this.isLoading = true;

            // firstly create an order
            await axios.post(route('order.create', { reference: this.reference }));

            // then confirm payment
            const { error } = await this.stripe.confirmPayment({
                elements: this.elements,
                confirmParams: {
                    return_url: route('order.success')
                }
            });

            if (error.type === "card_error" || error.type === "validation_error") {
                messages.value.push(error.message);
            } else {
                messages.value.push("An unexpected error occured.");
            }

            this.isLoading = false;
        },
        async init() {
            const publishableKey = env('VITE_STRIPE_KEY');
            this.stripe = await loadStripe(publishableKey);
            const user = usePage().props.auth.user;

            const { data } = await fetch(route('payment.init', { gateway: 'stripe' })).then((res) => res.json());

            const paymentElementOptions = {
                layout: "accordion",
                defaultValues: {
                    billingDetails: {
                        email: user.email
                    }
                }
            };

            this.elements = this.stripe.elements({ clientSecret: data.details.clientSecret });
            const paymentElement = this.elements.create('payment', paymentElementOptions);
            paymentElement.mount("#payment-element");

            const linkAuthenticationElement = this.elements.create("linkAuthentication");
            linkAuthenticationElement.mount("#link-authentication-element");

            this.reference = data.reference;

            this.isLoading = false;
        }
    },
    async mounted() {
        this.init().then();
    }
});
</script>
