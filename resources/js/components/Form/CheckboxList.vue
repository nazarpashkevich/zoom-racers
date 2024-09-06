<template>
    <ul class="flex flex-col gap-2">
        <template v-for="(option, index) in options" :key="index">
            <li class="flex gap-2 items-center text-sm text-gray-700 font-medium">
                <Checkbox
                    :checked="modelValue.includes(option.value)"
                    @change="recalculateValues($event.target.checked, option.value)"
                />
                {{ option.title }}
            </li>
        </template>
    </ul>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Checkbox from "@/components/Form/Checkbox.vue";

interface CheckBoxListItem {
    title: string,
    value: string
}

export default defineComponent({
    name: "CheckboxList",
    components: { Checkbox },
    props: {
        options: {
            type: Array as () => CheckBoxListItem[],
            default: () => []
        },
        modelValue: {
            type: Array as () => string[],
            default: () => []
        },
    },
    methods: {
        recalculateValues(checked: boolean, value: string) {
            let newValues = [...this.modelValue];

            if (checked) {
                if (!newValues.includes(value)) {
                    newValues.push(value);
                }
            } else {
                newValues = newValues.filter(item => item !== value);
            }

            this.$emit('update:modelValue', newValues);
        }
    }
});
</script>
