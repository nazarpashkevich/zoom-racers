<template>
    <span class="text-xl">Total: <span class="font-semibold">{{ formatPrice(amount) }}</span> </span>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import { formatPrice } from "@/helpers/money";
import Price from "@/contracts/common/Price";

export default defineComponent({
    name: "CartTotal",
    methods: { formatPrice },
    components: {},
    props: {
        amount: {
            type: Object as Price,
            required: true
        }
    }
})
</script>
