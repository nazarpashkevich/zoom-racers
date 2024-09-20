<template>
    <Head title="Cart"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex h-96">

                    <div class="m-auto text-xl font-medium text-center">
                        <img src="/images/order/confetti.gif" class="w-24 h-24 mx-auto mb-6" alt="">
                        <span>Yeep! <br>Your order was created successfully!</span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

export default defineComponent({
    components: {
        AuthenticatedLayout,
        Head
    },
    data: () => ({}),
    props: {}
});
</script>
