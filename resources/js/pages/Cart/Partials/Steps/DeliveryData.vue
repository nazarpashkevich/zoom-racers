<template>
    <form @submit.prevent="onSubmit" class="grid grid-cols-1 gap-8 py-12">
        <div>
            <InputLabel for="address" value="Address"/>
            <TextInput
                id="address"
                type="text"
                class="mt-1 block w-full"
                v-model="form.address"
                required
                autofocus
                autocomplete="address"
            />
            <InputError class="mt-2" :message="form.errors.address"/>
        </div>
    </form>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import TextInput from "@/components/Form/TextInput.vue";
import InputError from "@/components/Form/InputError.vue";
import InputLabel from "@/components/Form/InputLabel.vue";

export default defineComponent({
    name: "DeliveryData",
    components: { InputLabel, InputError, TextInput },
    props: {
        form: {
            type: Object,
            required: true
        }
    }
})
</script>
