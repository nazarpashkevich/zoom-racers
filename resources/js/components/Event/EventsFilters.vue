<template>
    <div class="px-12">
        <div class="flex gap-2 mb-12">
            <FilterIcon class="w-4 h-4 my-auto"/>
            <h2 class="font-semibold text-xl">Filters</h2>
        </div>
        <div class="flex gap-8 flex-col">
            <FilterItem title="Date">
                <VueDatePicker v-model="date" range :teleport="true" :auto-position="false"
                               :enable-time-picker="false"/>
            </FilterItem>
            <FilterItem title="Category">
                <CheckboxList v-model="categories"/>
            </FilterItem>
            <FilterItem title="Price">
                <CheckboxList v-model="priceRanges"/>
            </FilterItem>
            <FilterItem title="Languages">
                <CheckboxList v-model="languages"/>
            </FilterItem>
            <FilterItem title="Platforms">
                <CheckboxList v-model="platforms"/>
            </FilterItem>
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import FilterIcon from "@/components/Icons/FilterIcon.vue";
import Checkbox from "@/components/Form/Checkbox.vue";
import FilterItem from "@/components/Filter/FilterItem.vue";
import CheckboxList from "@/components/Form/CheckboxList.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import EventService from "@/services/EventService";

export default defineComponent({
    name: "EventsFilters",
    components: { CheckboxList, FilterItem, Checkbox, FilterIcon, VueDatePicker },
    data: () => ({
        date: null,
        priceRanges: [
            {
                key: 'low',
                title: '0-5',
                value: false
            },
            {
                key: 'medium',
                title: '5-10',
                value: false
            },
            {
                key: 'upper',
                title: '10-30',
                value: false
            },
            {
                key: 'expensive',
                title: '50+',
                value: false
            }
        ]
    }),
    async setup() {
        const service = EventService.make();
        const [languages, categories, platforms] = await Promise.all([
            service.languages(),
            service.categories(),
            service.platforms(),
        ]);
        
        return { languages, categories, platforms };
    }
})
</script>
