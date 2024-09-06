<script setup lang="ts">
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps<{
    checked: boolean;
    value?: any;
}>();

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
    <input
        type="radio"
        :value="value"
        :checked="checked"
        @change="handleChange"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
    />
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    name: 'RadioButton',
    props: {
        checked: {
            type: Boolean,
            required: true,
        },
        value: {
            type: [String, Number],
            default: null,
        },
    },
    methods: {
        handleChange(e) {
            this.$emit('update:checked', e.target.checked);
        },
    },
});
</script>
