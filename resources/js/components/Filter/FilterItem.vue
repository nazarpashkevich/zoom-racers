<template>
    <div class="">
        <div class="font-semibold text-md mb-3">{{ title }}:</div>
        <div class="pl-3">
            <slot></slot>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import Checkbox from "@/components/Form/Checkbox.vue";

export default defineComponent({
    name: "FilterItem",
    components: { Checkbox },
    props: {
        title: {
            type: String,
            required: true,
        },
    }
})
</script>
