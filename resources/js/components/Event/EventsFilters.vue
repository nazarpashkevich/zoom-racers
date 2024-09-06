<template>
    <div class="px-12">
        <div class="flex gap-2 mb-12">
            <FilterIcon class="w-4 h-4 my-auto"/>
            <h2 class="font-semibold text-xl">Filters</h2>
        </div>
        <div class="flex gap-8 flex-col">
            <FilterItem title="Date">
                <VueDatePicker
                    v-model="filterForm.filters.date"
                    range
                    :teleport="true"
                    :auto-position="false"
                    :enable-time-picker="false"
                />
            </FilterItem>
            <FilterItem title="Category">
                <CheckboxList v-model="filterForm.filters.category" :options="categories"/>
            </FilterItem>
            <FilterItem title="Price">
                <RadioButtonList v-model="filterForm.filters.priceRange" :options="priceRanges"/>
            </FilterItem>
            <FilterItem title="Languages">
                <CheckboxList v-model="filterForm.filters.language" :options="languages"/>
            </FilterItem>
            <FilterItem title="Platforms">
                <CheckboxList v-model="filterForm.filters.platform" :options="platforms"/>
            </FilterItem>

            <div class="flex justify-between">
                <PrimaryButton class="mt-4" @click="submitFilters">Apply</PrimaryButton>
                <SecondaryButton class="mt-4" @click="resetFilters">Reset</SecondaryButton>
            </div>
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
import { router, useForm } from "@inertiajs/vue3";
import RadioButtonList from "@/components/Form/RadioList.vue";
import SecondaryButton from "@/components/SecondaryButton.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";

export default defineComponent({
    name: "EventsFilters",
    components: {
        PrimaryButton,
        SecondaryButton,
        RadioButtonList,
        CheckboxList,
        FilterItem,
        Checkbox,
        FilterIcon,
        VueDatePicker
    },
    props: {
        route: {
            type: String,
            required: true
        },
        appliedFilters: {
            type: Object as Record<string, string[]>,
            default: {}
        }
    },
    methods: {
        submitFilters() {
            this.filterForm.get(this.route, { replace: true });
        },
        resetFilters() {
            router.visit(this.route);
        }
    },
    async setup(props) {
        const service = EventService.make();
        const [languages, categories, platforms, priceRanges] = await Promise.all([
            service.languages(),
            service.categories(),
            service.platforms(),
            service.priceRanges(),
        ]);

        const filterForm = useForm({
            filters: {
                date: props.appliedFilters?.date ?? null,
                language: props.appliedFilters?.language ?? [],
                category: props.appliedFilters?.category ?? [],
                platform: props.appliedFilters?.platform ?? [],
                priceRange: props.appliedFilters?.priceRange ?? null,
            }
        });

        return { languages, categories, platforms, priceRanges, filterForm };
    }
})
</script>
