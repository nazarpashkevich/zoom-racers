<template>
    <form @submit.prevent="onSubmit" class="grid grid-cols-2 gap-8 py-12">
        <div>
            <InputLabel for="name" value="Name"/>
            <TextInput
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />
            <InputError class="mt-2" :message="form.errors.name"/>
        </div>
        <div>
            <InputLabel for="email" value="Email"/>
            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="email"
            />
            <InputError class="mt-2" :message="form.errors.email"/>
        </div>
    </form>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import TextInput from "@/components/Form/TextInput.vue";
import InputError from "@/components/Form/InputError.vue";
import InputLabel from "@/components/Form/InputLabel.vue";

export default defineComponent({
    name: "UserData",
    components: { InputLabel, InputError, TextInput },
    props: {
        form: {
            type: Object,
            required: true
        }
    }
})
</script>
