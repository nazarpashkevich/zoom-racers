<template>
    <Head title="Checkout"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex divide-x">
                    <div class="flex-[2] py-8 gap-12">
                        <div class="px-24 h-full">
                            <CheckoutSteps
                                :steps-count="3"
                                :labels="stepsLabels"
                                :model-value="currentStep"
                                @update:model-value="setStep"
                            />

                            <UserData v-if="currentStep === 1" :form="form"/>
                            <DeliveryData v-else-if="currentStep === 2" :form="form"/>
                            <Suspense v-else-if="currentStep === 3">
                                <PaymentData :form="form"/>
                            </Suspense>

                            <div class="mt-auto">
                                <SecondaryButton v-if="currentStep > 1" @click="previousStep">Back</SecondaryButton>
                                <PrimaryButton
                                    v-if="currentStep !== 3"
                                    class="float-right"
                                    @click="setStep(currentStep +1)">
                                    Next
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-col w-full my-6 px-4 divide-y">
                            <OrderTotal :order="order"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent, ref, watch } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head, router, useForm, usePage } from '@inertiajs/vue3';
import Cart from "@/contracts/cart/Cart";
import OrderTotal from "@/pages/Order/Partials/OrderTotal.vue";
import CheckoutSteps from "@/pages/Order/Partials/CheckoutSteps.vue";
import TextInput from "@/components/Form/TextInput.vue";
import UiSelect from "@/components/Form/UiSelect.vue";
import InputError from "@/components/Form/InputError.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import DragAndDropInputInput from "@/components/Form/DragAndDropInputInput.vue";
import InputLabel from "@/components/Form/InputLabel.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import UserData from "@/pages/Cart/Partials/Steps/UserData.vue";
import DeliveryData from "@/pages/Cart/Partials/Steps/DeliveryData.vue";
import PaymentData from "@/pages/Cart/Partials/Steps/PaymentData.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import { Order } from "@stripe/stripe-js";
import UserOrder from "@/contracts/order/UserOrder";

export default defineComponent({
    methods: {},
    components: {
        SecondaryButton,
        PaymentData,
        DeliveryData,
        UserData,
        PrimaryButton,
        InputLabel, DragAndDropInputInput, VueDatePicker, InputError, UiSelect, TextInput,
        CheckoutSteps,
        OrderTotal,
        AuthenticatedLayout,
        Head
    },
    data: () => ({
        stepsLabels: ['User Data', 'Delivery', 'Payment'],
        currentStep: 1
    }),
    methods: {
        async setStep(step: number) {
            if (this.currentStep < 3) {
                // save data
                router.put(
                    route('order.save'),
                    { ...this.form.data(), step: step },
                    { preserveScroll: true }
                );
            }
        },
        previousStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },
        init() {
            this.currentStep = this.step;
        }
    },
    props: {
        order: {
            type: Object as UserOrder,
            required: true
        },
        step: {
            type: Number,
            required: true
        }
    },
    updated() {
        this.init();
    },
    mounted() {
        this.init();
    },
    setup(props) {
        const page = usePage().props;
        const user = page.auth.user;
        const order = props.order;

        const form = useForm({
            name: order.details.name ?? user.name,
            email: order.details.email ?? user.email,
            address: order.details.address ?? ''
        });

        // options api doesn't work
        watch(
            () => props.order.cart,
            () => router.visit(route('order.index', { step: props.step })),
            { deep: true }
        );

        return { form };
    }
});
</script>
