<template>
    <div class="py-4 px-12 flex gap-8 justify-end">
        <div class="flex gap-3 items-center">
            <InputLabel value="Show past" class="text-slate-600"/>
            <Checkbox :checked="false"/>
        </div>
        <div class="flex gap-3 items-center">
            <InputLabel value="Show cancelled" class="text-slate-600"/>
            <Checkbox :checked="false"/>
        </div>
    </div>
    <div class="px-12 py-8 divide-y flex flex-col gap-4">
        <h2 class="text-2xl font-medium text-slate-700">Today</h2>
        <div class="py-4 px-12 grid grid-cols-3 gap-6">
            <EventSmallCard>
                <template #actions>
                    <!-- only for future/happening events -->
                    <DropdownLink :href="route('profile.edit')">Connect</DropdownLink>
                    <DropdownLink :href="route('profile.edit')">Download receipt</DropdownLink>
                    <DropdownLink :href="route('profile.edit')">Cancel</DropdownLink>
                </template>
            </EventSmallCard>
            <EventSmallCard>
                <template #actions>
                    <!-- only for future/happening events -->
                    <DropdownLink :href="route('profile.edit')">Connect</DropdownLink>
                    <DropdownLink :href="route('profile.edit')">Cancel</DropdownLink>
                </template>
            </EventSmallCard>
            <EventSmallCard>
                <template #actions>
                    <!-- only for future/happening events -->
                    <DropdownLink :href="route('profile.edit')">Connect</DropdownLink>
                    <DropdownLink :href="route('profile.edit')">Cancel</DropdownLink>
                </template>
            </EventSmallCard>
            <EventSmallCard>
                <template #actions>
                    <!-- only for future/happening events -->
                    <DropdownLink :href="route('profile.edit')">Connect</DropdownLink>
                    <DropdownLink :href="route('profile.edit')">Cancel</DropdownLink>
                </template>
            </EventSmallCard>
            <EventSmallCard>
                <template #actions>
                    <!-- only for future/happening events -->
                    <DropdownLink :href="route('profile.edit')">Connect</DropdownLink>
                    <DropdownLink :href="route('profile.edit')">Cancel</DropdownLink>
                </template>
            </EventSmallCard>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import EventSmallCard from "@/components/Event/EventSmallCard.vue";
import DropdownLink from "@/components/DropdownLink.vue";
import InputLabel from "@/components/Form/InputLabel.vue";
import Checkbox from "@/components/Form/Checkbox.vue";

export default defineComponent({
    name: "TicketList",
    components: { Checkbox, InputLabel, DropdownLink, EventSmallCard }
})
</script>
