<template>
    <div class="flex mb-12">
        <h1 class="font-semibold text-2xl text-gray-800">All events <span class="text-gray-600 ml-2">(123+)</span></h1>
        <div class="ml-auto flex">
            <SortSelect v-if="withSort" class="mr-8" :options="sortOptions" path="events.index"/>
            <ViewChanger v-if="withViewMode" :model-value="viewMode" @update:model-value="updateViewMode"/>
        </div>
    </div>
    <div class="grid mb-12" :class="[viewMode === listViewModes.Grid ? 'grid-cols-3 gap-12' : 'grid-cols-1 divide-y']">
        <template v-for="event in events.data">
            <EventGridCard v-if="viewMode === listViewModes.Grid" :event="event"/>
            <EventListCard v-else :event="event"/>
        </template>
    </div>
    <div class="flex justify-center">
        <Pagination :meta="events.meta"/>
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
import { BaseData } from "@/contracts/List";
import EventModel from "@/contracts/events/EventModel";
import SortSelect from "@/components/List/SortSelect.vue";

export default defineComponent({
    name: "EventsList",
    components: {
        SortSelect,
        EventListCard,
        Pagination,
        EventGridCard,
        ViewChanger,
        GridViewIcon,
        ListViewIcon,
        UiSelect
    },
    computed: {
        viewMode() {
            return this.$store.state.viewMode.mode;
        }
    },
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
    }),
    methods: {
        updateViewMode(mode: ListViewMode) {
            this.$store.dispatch('setMode', mode);
        }
    },
    props: {
        withSort: {
            type: Boolean,
            default: true
        },
        withViewMode: {
            type: Boolean,
            default: true
        },
        events: {
            type: Object as BaseData<EventModel>,
            required: true
        }
    },

})
</script>
