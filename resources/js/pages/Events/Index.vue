<template>
  <Head title="Index"/>

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="container mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex divide-x"
        >
          <template v-if="events.meta?.total > 0">
            <div class="flex-1 py-8 hidden xl:block">
              <Suspense>
                <EventsFilters
                  :applied-filters="filters"
                  :route="route('events.index', { sort })"
                />
              </Suspense>
            </div>
            <div class="flex-[3] px-12 py-8 gap-12">
              <EventsList :events="events"/>

            </div>

            <!-- Mobile filters -->
            <Modal :show="showFilters" @close="showFilters = false">
              <div class="py-6">
                <Suspense>
                  <EventsFilters
                    :applied-filters="filters"
                    :route="route('events.index', { sort })"
                  />
                </Suspense>
              </div>
            </Modal>
          </template>
          <template v-else>
            <EmptyState/>
          </template>
        </div>
        <PrimaryButton
          v-if="!showFilters"
          class="sticky bottom-12 left-12 animate-bounce rounded-full"
          @click="showFilters = true"
        >
          <FilterIcon class="w-6 h-6 fill-white"/>
        </PrimaryButton>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import EventsList from '@/pages/Events/Partials/EventsList.vue';
import { ListViewModeEnum } from '@/enums/list-view-mode.enum';
import EventsFilters from '@/components/Event/EventsFilters.vue';
import { BaseData } from '@/types/common';
import { EventModel } from '@/types/event';
import EmptyState from '@/components/EmptyState.vue';
import Modal from "@/components/Modal.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import DangerButton from "@/components/DangerButton.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import FilterIcon from "@/components/Icons/FilterIcon.vue";

export default defineComponent({
  components: {
    FilterIcon,
    PrimaryButton,
    DangerButton, SecondaryButton, Modal,
    EmptyState,
    EventsFilters,
    AuthenticatedLayout,
    EventsList,
    Head,
  },
  data: () => ({
    viewMode: ListViewModeEnum.Grid,
    showFilters: false,
  }),
  props: {
    events: {
      type: Object as BaseData<EventModel>,
      required: true,
    },
    filters: {
      type: Object as Record<string, string[]>,
      required: true,
    },
  },
  setup() {
    const sort = new URLSearchParams(window.location.search).get('sort');

    return { sort };
  },
});
</script>
