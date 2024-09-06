<template>
    <Head title="Index"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex divide-x">
                    <div class="flex-1 py-8">
                        <Suspense>
                            <EventsFilters :route="route('events.index', {sort})"
                                           :applied-filters="filters"/>
                        </Suspense>
                    </div>
                    <div class="flex-[3] px-12 py-8 gap-12">
                        <EventsList :events="events"/>
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
import EventsFilters from "@/components/Event/EventsFilters.vue";
import { BaseData } from "@/contracts/List";
import EventModel from "@/contracts/events/EventModel";

export default defineComponent({
    components: {
        EventsFilters,
        AuthenticatedLayout,
        EventsList,
        Head
    },
    data: () => ({
        viewMode: ListViewMode.Grid
    }),
    props: {
        events: {
            type: Object as BaseData<EventModel>,
            required: true
        },
        filters: {
            type: Object as Record<string, string[]>,
            required: true
        }
    },
    setup() {
        const sort = new URLSearchParams(window.location.search).get('sort');

        return { sort };
    }
});
</script>
