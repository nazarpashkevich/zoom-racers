<template>
    <div class="flex max-w-md flex-col items-center mx-auto space-x-4">
        <div class="flex w-full space-x-4">
            <template v-for="(step, index) in stepsCount" :key="index">
                <CheckoutStep
                    :isActive="currentStep === step"
                    :isComplete="currentStep > step"
                    :isUpcoming="currentStep < step"
                    :label="labels[step - 1]"
                    @click="changeStep(step)"
                >
                    {{ step }}
                </CheckoutStep>

                <div
                    v-if="index < stepsCount - 1"
                    class="flex-1 mt-3"
                    :class="[ currentStep > step ? 'border-t-4 border-purple-300' :
                    'border-t-4 border-gray-300 border-dotted']"
                ></div>
            </template>
        </div>
    </div>
</template>

<script lang="ts">
import CheckoutStep from './CheckoutStep.vue';
import { defineComponent } from "vue";

export default defineComponent({
    name: "CheckoutSteps",
    components: { CheckoutStep },
    props: {
        modelValue: {
            type: Number,
            required: true,
        },
        stepsCount: {
            type: Number,
            required: true,
        },
        labels: {
            type: Array,
            required: true,
        }
    },
    computed: {
        currentStep: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        }
    },
    methods: {
        changeStep(stepNumber) {
            this.currentStep = stepNumber;
        }
    }
});
</script>
