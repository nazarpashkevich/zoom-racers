<template>
    <input
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="modelValue"
        @change="(e) => this.$emit('update:modelValue', e.target.value)"
        ref="input"
    />
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    props: {
        modelValue: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            input: null as HTMLInputElement | null,
        };
    },
    mounted() {
        if (this.input?.hasAttribute('autofocus')) {
            this.input.focus();
        }
    },
    methods: {
        focus() {
            this.input?.focus();
        },
    },
    expose() {
        return {
            focus: this.focus,
        };
    }
});
</script>
