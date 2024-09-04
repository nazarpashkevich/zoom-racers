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

export default defineComponent({
    name: "EventsFilters",
    components: { CheckboxList, FilterItem, Checkbox, FilterIcon, VueDatePicker },
    data: () => ({
        date: null,
        categories: [
            {
                key: 'Category 1',
                title: 'Category 1',
                value: false
            },
            {
                key: 'Category 2',
                title: 'Category 2',
                value: false
            },
            {
                key: 'Category 3',
                title: 'Category 3',
                value: false
            }
        ],
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
        ],
        languages: [
            {
                key: 'english',
                title: 'English',
                value: false
            },
            {
                key: 'spanish',
                title: 'Spanish',
                value: false
            },
            {
                key: 'dutch',
                title: 'Dutch',
                value: false
            },
            {
                key: 'other',
                title: 'Other',
                value: false
            }
        ]
    })
})
</script>
