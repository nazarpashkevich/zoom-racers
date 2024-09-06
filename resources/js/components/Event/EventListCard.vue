<template>
    <Link class="flex gap-4 hover:bg-gray-50 py-8 px-6 h-72 cursor-pointer" :href="route('events.show', event.id)">
        <div class="w-1/3 px-12">
            <div class="bg-cover bg-center rounded-md w-full h-full"
                 :style="{backgroundImage: `url('${event.picture}')`}"></div>
        </div>
        <div class="flex w-2/3">
            <div class="w-1/2 flex flex-col gap-2">
                <div class="text-xl font-semibold text-left hover:text-indigo-900">{{ event.title }}</div>
                <div class="text-xs text-gray-500">{{ resource.date() }}</div>
                <div class="text-md font-semibold">{{ resource.price() }}</div>
                <div class="flex gap-4">
                    <div class="text-xs rounded-lg px-4 py-1 bg-purple-50 text-purple-700 inline-block">
                        {{ event.language.title }}
                    </div>
                    <div class="text-xs rounded-lg px-4 py-1 bg-yellow-50 text-orange-500 inline-block">
                        {{ event.category.title }}
                    </div>
                </div>
                <div
                    class="text-xs rounded-lg px-4 py-1 bg-blue-50 text-blue-500 inline-block mb-6 flex gap-2 items-center
                    max-w-48">
                    <LocationIcon class="w-3 h-3 fill-blue-500"/>
                    {{ event.platform.title }}
                </div>
            </div>
            <div class="w-1/2 text-right">
                <template v-if="!hasActionSlot">
                    <PrimaryButton class="ml-auto">
                        <div class="flex gap-2 justify-center w-full">
                            <BasketIcon class="fill-white w-4 h-4"/>
                            Add to Card
                        </div>
                    </PrimaryButton>
                </template>
                <div v-else class="ml-auto">
                    <slot name="actions"/>
                </div>
            </div>
        </div>
    </Link>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import PrimaryButton from "@/components/PrimaryButton.vue";
import BasketIcon from "@/components/Icons/BasketIcon.vue";
import LocationIcon from "@/components/Icons/LocationIcon.vue";
import { Link } from '@inertiajs/vue3'
import EventModel from "@/contracts/events/EventModel";
import EventResource from "@/resources/EventResource";

export default defineComponent({
    name: "EventListCard",
    components: { LocationIcon, BasketIcon, PrimaryButton, Link },
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
