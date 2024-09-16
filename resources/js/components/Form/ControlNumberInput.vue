<template>
    <div class="relative flex items-center w-24">
        <button
            type="button"
            @click.prevent="decrement"
            class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-2 h-8 focus:ring-gray-100 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 1h16"/>
            </svg>
        </button>
        <input
            type="text"
            :value="modelValue"
            @input="updateValue($event.target.value)"
            class="bg-gray-50 border-x-0 border-gray-300 h-8 text-center text-gray-900 text-sm focus:ring-blue-500
             focus:border-blue-500 block w-full py-2.5" required/>
        <button
            type="button"
            @click.prevent="increment"
            class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-2 h-8 focus:ring-gray-100 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 1v16M1 9h16"/>
            </svg>
        </button>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        modelValue: {
            type: [String, Number],
            required: true,
        },
    },
    methods: {
        increment() {
            const newValue = Number(this.modelValue) + 1;
            this.$emit('update:modelValue', newValue);
        },
        decrement() {
            const newValue = Number(this.modelValue) - 1;
            if (newValue >= 0) {
                this.$emit('update:modelValue', newValue);
            }
        },
        updateValue(value: string) {
            const parsedValue = Number(value);
            if (!isNaN(parsedValue) && parsedValue >= 0) {
                this.$emit('update:modelValue', parsedValue);
            }
        },
    },
});
</script>
