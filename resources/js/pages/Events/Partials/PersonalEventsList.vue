<template>
    <div class="flex mb-12">
        <h1 class="font-semibold text-2xl text-gray-800">My Events <span class="text-gray-600 ml-2">(123+)</span></h1>
        <Link :href="route('personal-events.create')" class="ml-auto">
            <PrimaryButton>Add</PrimaryButton>
        </Link>
    </div>
    <div class="grid mb-12 grid-cols-1 divide-y">
        <template v-for="event in events.data">
            <EventListCard :event="event">
                <template #actions>
                    <div class="flex flex-col max-w-32 gap-4 justify-end mx-auto">
                        <PrimaryButton @click.prevent="() => router.visit(route('personal-events.edit', event.id))">
                            Edit
                        </PrimaryButton>
                        <SecondaryButton @click.prevent="() => router.visit(route('events.show', event.id))">
                            Show
                        </SecondaryButton>
                        <DangerButton @click.prevent="itemToDelete = event.id">
                            Delete
                        </DangerButton>
                    </div>
                </template>
            </EventListCard>
        </template>
    </div>
    <div class="flex justify-center">
        <Pagination class="py-4" :meta="events.meta"/>
    </div>
    <Modal :show="Number.isInteger(itemToDelete)" @close="() => itemToDelete = null">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to delete this item?
            </h2>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="() => itemToDelete = null"> Cancel</SecondaryButton>
                <DangerButton class="ms-3" @click="deleteItem">Delete</DangerButton>
            </div>
        </div>
    </Modal>
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
import PrimaryButton from "@/components/PrimaryButton.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import DangerButton from "@/components/DangerButton.vue";
import { Link, router } from '@inertiajs/vue3'
import Modal from "@/components/Modal.vue";
import TextInput from "@/components/Form/TextInput.vue";
import InputLabel from "@/components/Form/InputLabel.vue";
import InputError from "@/components/Form/InputError.vue";
import { BaseData } from "@/contracts/List";
import EventModel from "@/contracts/events/EventModel";

export default defineComponent({
    name: "PersonalEventsList",
    components: {
        InputError, InputLabel, TextInput, Modal,
        DangerButton,
        SecondaryButton,
        PrimaryButton,
        EventListCard,
        Pagination,
        EventGridCard,
        ViewChanger,
        GridViewIcon,
        ListViewIcon,
        Link,
        UiSelect
    },
    data: () => ({
        itemToDelete: null,
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
    props: {
        viewMode: {
            type: String as ListViewMode,
            default: ListViewMode.Grid
        },
        events: {
            type: Object as BaseData<EventModel>,
            required: true
        }
    },
    methods: {
        deleteItem() {
            this.itemToDelete = null;
            return;
        }
    },
    setup() {
        return { router };
    }
})
</script>
