<script setup lang="ts">
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NewUsersChart from "@/pages/Dashboard/Partials/NewUsersChart.vue";
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <div class="text-2xl font-semibold mb-12">🚀 Ahhh some insights of our achieves </div>
                    <div class="grid grid-cols-2 gap-12">
                        <NewUsersChart />
                        <NewUsersChart />
                        <NewUsersChart />
                        <NewUsersChart />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
