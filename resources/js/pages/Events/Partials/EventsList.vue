<template>
    <div class="flex mb-12">
        <h1 class="font-semibold text-2xl text-gray-800">All events <span class="text-gray-600 ml-2">(123+)</span></h1>
        <div class="ml-auto flex">
            <div v-if="withSort" class="mr-8 flex items-center">
                <span class="mr-4 text-sm text-slate-500">Sort by</span>
                <UiSelect v-model="sort" :options="sortOptions"/>
            </div>
            <ViewChanger v-if="withViewMode" v-model="viewMode"/>
        </div>
    </div>
    <div class="grid gap-12 mb-12" :class="[viewMode === listViewModes.Grid ? 'grid-cols-3 ' : 'grid-cols-1 divide-y']">
        <template v-if="viewMode === listViewModes.Grid">
            <EventGridCard/>
            <EventGridCard/>
            <EventGridCard/>
        </template>
        <template v-else>
            <EventListCard/>
            <EventListCard/>
            <EventListCard/>
        </template>
    </div>
    <div class="flex justify-center">
        <Pagination :meta="paginator"/>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import UiSelect from "@/components/Form/UiSelect.vue";
import ListViewIcon from "@/components/Icons/ListViewIcon.vue";
import GridViewIcon from "@/components/Icons/GridViewIcon.vue";
import ViewChanger from "@/components/List/ViewChanger.vue";
import { ListViewMode } from "@/enums/ListViewMode";
import EventGridCard from "@/components/Event/EventGridCard.vue";
import Pagination from "@/components/List/Pagination.vue";
import EventListCard from "@/components/Event/EventListCard.vue";

export default defineComponent({
    name: "EventsList",
    components: { EventListCard, Pagination, EventGridCard, ViewChanger, GridViewIcon, ListViewIcon, UiSelect },
    data: () => ({
        sort: "",
        sortOptions: [
            { title: 'Default', value: "" },
            { title: 'Price (asc)', value: "price:asc" },
            { title: 'Price (desc)', value: "price:desc" },
            { title: 'Date (asc)', value: "date:asc" },
            { title: 'Date (desc)', value: "date:desc" },
        ],
        listViewModes: ListViewMode,
        viewMode: ListViewMode.Grid,
        paginator: {
            from: 1,
            to: 3,
            current_page: 1,
            last_page: 3,
            per_page: 10,
            total: 28,
            path: '/',
            pageName: 'page',
        }
    }),
    props: {
        withSort: {
            type: Boolean,
            default: true
        },
        withViewMode: {
            type: Boolean,
            default: true
        }
    }
})
</script>
