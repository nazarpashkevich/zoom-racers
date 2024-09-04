<template>
    <Head title="Index"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tickets</h2>
        </template>
        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg divide-y">
                    <TicketList/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TicketList from "@/pages/Tickets/Partials/TicketList.vue";

export default defineComponent({
    components: {
        TicketList,
        AuthenticatedLayout,
        Head
    },
});
</script>
