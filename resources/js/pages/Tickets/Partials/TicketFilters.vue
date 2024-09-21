<template>
    <div class="py-4 px-12 flex gap-8 justify-end">
        <div class="flex gap-3 items-center">
            <InputLabel value="Show past" class="text-slate-600"/>
            <Checkbox
                :checked="filtersForm.filters.showPast"
                @update:checked="(v) => updateFilter('showPast', v)"
            />
        </div>
        <div class="flex gap-3 items-center">
            <InputLabel value="Show cancelled" class="text-slate-600"/>
            <Checkbox
                :checked="filtersForm.filters.showCancelled"
                @update:checked="(v) => updateFilter('showCancelled', v)"
            />
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import EventSmallCard from "@/components/Event/EventSmallCard.vue";
import DropdownLink from "@/components/DropdownLink.vue";
import InputLabel from "@/components/Form/InputLabel.vue";
import Checkbox from "@/components/Form/Checkbox.vue";
import { useForm } from "@inertiajs/vue3";

export default defineComponent({
    name: "TickerFilters",
    components: { Checkbox, InputLabel, DropdownLink, EventSmallCard },
    props: {
        filters: {
            type: Object,
            default: {}
        }
    },
    methods: {
        updateFilter(prop: string, value: boolean) {
            this.filtersForm.filters[prop] = value;
            this.filtersForm.get(route('tickets.index'));
        }
    },
    setup(props) {
        const filtersForm = useForm({
            filters: {
                showPast: props.filters.showPast ?? false,
                showCancelled: props.filters.showCancelled ?? false
            }
        });

        return { filtersForm };
    }
})
</script>
