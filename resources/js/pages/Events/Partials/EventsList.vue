<template>
  <div class="flex mb-12 flex-col md:flex-row gap-8">
    <h1 class="font-semibold text-2xl text-gray-800">
      All events
      <span class="text-gray-600 ml-2">({{ events.meta?.total }}+)</span>
    </h1>

    <div class="ml-0 md:ml-auto justify-between flex">
      <SortSelect
        v-if="withSort"
        :options="sortOptions"
        class="mr-8"
        path="events.index"
      />
      <ViewChanger
        v-if="withViewMode"
        :model-value="viewMode"
        @update:model-value="updateViewMode"
      />
    </div>
  </div>
  <div
    :class="[
      viewMode === listViewModes.Grid
        ? 'grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12 max-md:divide-y'
        : 'grid-cols-1 divide-y',
    ]"
    class="grid mb-12"
  >
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
import { defineComponent } from 'vue';
import UiSelect from '@/components/Form/UiSelect.vue';
import ListViewIcon from '@/components/Icons/ListViewIcon.vue';
import GridViewIcon from '@/components/Icons/GridViewIcon.vue';
import ViewChanger from '@/components/List/ViewChanger.vue';
import { ListViewModeEnum } from '@/enums/list-view-mode.enum';
import EventGridCard from '@/components/Event/EventGridCard.vue';
import Pagination from '@/components/List/Pagination.vue';
import EventListCard from '@/components/Event/EventListCard.vue';
import SortSelect from '@/components/List/SortSelect.vue';
import { BaseData } from '@/types/common';
import { EventModel } from '@/types/event';

export default defineComponent({
  name: 'EventsList',
  components: {
    SortSelect,
    EventListCard,
    Pagination,
    EventGridCard,
    ViewChanger,
    GridViewIcon,
    ListViewIcon,
    UiSelect,
  },
  computed: {
    viewMode() {
      return this.$store.state.viewMode.mode;
    },
  },
  data: () => ({
    sort: '',
    sortOptions: [
      { title: 'Default', value: '' },
      { title: 'Price (asc)', value: 'price:asc' },
      { title: 'Price (desc)', value: 'price:desc' },
      { title: 'Date (asc)', value: 'date:asc' },
      { title: 'Date (desc)', value: 'date:desc' },
    ],
    listViewModes: ListViewModeEnum,
  }),
  methods: {
    updateViewMode(mode: ListViewModeEnum) {
      this.$store.dispatch('setMode', mode);
    },
  },
  props: {
    withSort: {
      type: Boolean,
      default: true,
    },
    withViewMode: {
      type: Boolean,
      default: true,
    },
    events: {
      type: Object as BaseData<EventModel>,
      required: true,
    },
  },
});
</script>
<script lang="ts" setup></script>
