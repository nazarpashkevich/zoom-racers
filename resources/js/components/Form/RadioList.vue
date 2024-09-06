<template>
    <ul class="flex flex-col gap-2">
        <template v-for="(option, index) in options" :key="index">
            <li class="flex gap-2 items-center text-sm text-gray-700 font-medium">
                <RadioButton
                    :checked="modelValue === option.value"
                    @update:checked="selectValue(option.value)"
                />
                {{ option.title }}
            </li>
        </template>
    </ul>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import RadioButton from "@/components/Form/RadioButton.vue";
import DictionaribleEnum from "@/contracts/common/DictionaribleEnum";

export default defineComponent({
    name: "RadioButtonList",
    components: { RadioButton },
    props: {
        options: {
            type: Array as () => DictionaribleEnum[],
            default: () => []
        },
        modelValue: {
            type: [String, null],
            default: ''
        },
    },
    methods: {
        selectValue(value: string) {
            this.$emit('update:modelValue', value);
        }
    }
});
</script>

