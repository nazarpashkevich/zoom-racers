<template>
    <Head title="Personal"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex divide-x">
                    <!-- filters -->

                    <div class="flex-1 py-8">
                    </div>
                    <div class="flex-[3] px-12 py-8 gap-12 divide-y">
                        <PersonalEventsList :events="events"/>
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
import EventsList from "@/pages/Events/Partials/EventsList.vue";
import { ListViewMode } from "@/enums/ListViewMode";
import PersonalEventsList from "@/pages/Events/Partials/PersonalEventsList.vue";
import { BaseData } from "@/contracts/List";
import EventModel from "@/contracts/events/EventModel";

export default defineComponent({
    components: {
        PersonalEventsList,
        AuthenticatedLayout,
        EventsList,
        Head
    },
    data: () => ({
        viewMode: ListViewMode.List
    }),
    props: {
        events: {
            type: Object as BaseData<EventModel>,
            required: true
        }
    }
});
</script>
