<template>
    <div class="relative min-w-48">
        <div class="text-sm py-2 px-4 border flex cursor-pointer hover:bg-gray-50"
             :class="[isOpened ? 'rounded-t-lg' : ' rounded-lg']"
             @click="isOpened = !isOpened">
            <span>{{ displayValue }}</span>
            <ArrowIcon class="w-2 h-2 ml-auto my-auto rotate-90"/>
        </div>
        <template v-if="isOpened">
            <ul
                class="absolute l-0 t-0 divide-y border border-rounded-sm shadow-sm w-full rounded-b-lg bg-white z-[100]">
                <template v-for="option in options">
                    <li class="py-2 px-6 text-sm text-gray-700 hover:bg-gray-50 cursor-pointer"
                        @click="() => onSelectValue(option)">
                        {{ option.title }}
                    </li>
                </template>
            </ul>
        </template>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import ArrowIcon from "@/components/Icons/ArrowIcon.vue";

interface SelectOption {
    title: string,
    value: string
}

export default defineComponent({
    name: "UiSelect",
    components: { ArrowIcon },
    computed: {
        displayValue(): String {
            return this.options.find(option => option.value === this.modelValue)?.title ?? 'Select Item';
        }
    },
    data: () => ({
        isOpened: false
    }),
    methods: {
        onSelectValue(option: SelectOption) {
            this.$emit('update:modelValue', option.value);
            this.isOpened = false;
        }
    },
    props: {
        modelValue: {
            type: String,
            required: true
        },
        options: {
            type: Array as SelectOption[],
            default: []
        }
    }
})
</script>
