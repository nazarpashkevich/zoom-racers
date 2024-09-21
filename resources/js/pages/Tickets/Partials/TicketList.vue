<template>
    <div class="px-12 py-8 divide-y flex flex-col gap-4">
        <h2 class="text-2xl font-medium text-slate-700">Today</h2>
        <div class="py-4 px-12 grid grid-cols-3 gap-6">
            <template v-for="ticket in tickets">
                <EventSmallCard :event="ticket.event">
                    <template #actions>
                        <!-- only for future/happening events -->
                        <template v-if="!ticket.isCanceled">
                            <DropdownLink :href="ticket.event.link">Connect</DropdownLink>
                            <DropdownLink
                                v-if="ticket.ticketPath"
                                href="#"
                                @click.prevent="() => downloadRecipe(ticket)"
                            >
                                Download receipt
                            </DropdownLink>
                            <DropdownLink :href="route('tickets.cancel', ticket.id)">Cancel</DropdownLink>
                        </template>
                        <template v-else>
                            <DropdownLink :href="route('tickets.archive', ticket.id)">Archive</DropdownLink>
                        </template>
                    </template>
                </EventSmallCard>
            </template>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import EventSmallCard from "@/components/Event/EventSmallCard.vue";
import DropdownLink from "@/components/DropdownLink.vue";
import InputLabel from "@/components/Form/InputLabel.vue";
import Checkbox from "@/components/Form/Checkbox.vue";
import Ticket from "@/contracts/tickets/Ticket";

export default defineComponent({
    name: "TicketList",
    components: { Checkbox, InputLabel, DropdownLink, EventSmallCard },
    props: {
        tickets: {
            type: Array as Ticket[],
            required: true
        }
    },
    methods: {
        downloadRecipe(ticket: Ticket) {
            window.open(ticket.ticketPath);
        }
    }
})
</script>
