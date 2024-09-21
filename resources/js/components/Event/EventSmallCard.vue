<template>
    <div
        class="flex gap-12 hover:bg-gray-50 rounded-lg py-4 px-6 w-96 border border-slate-200 shadow-sm pr-8 relative">
        <div class="w-1/3">
            <div
                class="bg-cover bg-center rounded-full w-24 h-24"
                :style="{backgroundImage: `url('${event.picture}')`}"></div>
        </div>
        <div class="w-2/3">
            <div class="flex flex-col gap-2">
                <div class="text-md font-semibold text-left">{{ event.title }}</div>
                <div class="text-xs text-gray-500">{{ resource.date() }}</div>
                <div class="flex gap-4">
                    <div class="text-xs rounded-lg px-4 py-1 bg-purple-50 text-purple-700 inline-block">
                        {{ event.language.title }}
                    </div>
                    <div class="text-xs rounded-lg px-4 py-1 bg-yellow-50 text-orange-500 inline-block">
                        {{ event.category.title }}
                    </div>
                </div>
            </div>
        </div>
        <div v-if="hasActionSlot" class="absolute top-3 right-2 cursor-pointer">
            <Dropdown align="left" width="48">
                <template #trigger>
                    <ThreeDotsIcon class="w-3 rotate-90 fill-slate-500"/>
                </template>

                <template #content>
                    <slot name="actions"/>
                </template>
            </Dropdown>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import PrimaryButton from "@/components/PrimaryButton.vue";
import BasketIcon from "@/components/Icons/BasketIcon.vue";
import LocationIcon from "@/components/Icons/LocationIcon.vue";
import { Link } from '@inertiajs/vue3'
import ThreeDotsIcon from "@/components/Icons/ThreeDotsIcon.vue";
import DropdownLink from "@/components/DropdownLink.vue";
import Dropdown from "@/components/Dropdown.vue";
import EventModel from "@/contracts/events/EventModel";
import EventResource from "@/resources/EventResource";

export default defineComponent({
    name: "EventSmallCard",
    components: { Dropdown, DropdownLink, ThreeDotsIcon, LocationIcon, BasketIcon, PrimaryButton, Link },
    computed: {
        hasActionSlot() {
            return !!this.$slots.actions;
        }
    },
    props: {
        event: {
            type: Object as EventModel,
            required: true
        }
    },
    setup(props) {
        const resource = new EventResource(props.event);

        return { resource };
    }
})
</script>
