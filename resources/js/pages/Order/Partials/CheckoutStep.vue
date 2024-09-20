<template>
    <div class="flex flex-col items-center text-xs cursor-pointer">
        <div class="flex items-center justify-center rounded-full h-6 w-6 shadow-lg" :class="classes">
            <slot></slot>
        </div>
        <span class="mt-2" :class="labelClasses">{{ label }}</span>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    name: "CheckoutStep",
    computed: {
        classes() {
            return [
                this.isActive ? 'bg-green-600 shadow-xl text-white' : '',
                this.isComplete ? 'bg-indigo-800 text-white' : '',
                this.isUpcoming ? 'bg-gray-300 text-gray-500' : ''
            ];
        },
        labelClasses() {
            return [
                this.isUpcoming ? 'text-gray-400' : 'text-gray-600'
            ];
        }
    },
    props: {
        isActive: {
            type: Boolean,
            default: false,
        },
        isComplete: {
            type: Boolean,
            default: false,
        },
        isUpcoming: {
            type: Boolean,
            default: false,
        },
        label: {
            type: String,
            required: true,
        },
    },
});
</script>
