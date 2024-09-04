<template>
    <ul class="flex flex-col gap-2">
        <template v-for="option in modelValue">
            <li class="flex gap-2 items-center text-sm text-gray-700 font-medium">
                <Checkbox :checked="false" v-model="option.value" @update:modelValue="recalculateValues"/>
                {{ option.title }}
            </li>
        </template>
    </ul>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import Checkbox from "@/components/Form/Checkbox.vue";

interface CheckBoxListItem {
    key: string,
    title: string,
    value: boolean
}

export default defineComponent({
    name: "CheckboxList",
    components: { Checkbox },
    props: {
        modelValue: {
            type: Array as CheckBoxListItem[],
            default: []
        },
    },
    methods: {
        recalculateValues() {
            this.$emit('modelValue', this.options);
        }
    }
})
</script>
