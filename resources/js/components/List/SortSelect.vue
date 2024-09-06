<template>
    <div class="flex items-center">
        <span class="mr-4 text-sm text-slate-500">Sort by</span>
        <UiSelect :model-value="sort" :options="options" @update:model-value="doSort"/>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import UiSelect from "@/components/Form/UiSelect.vue";
import { router } from "@inertiajs/vue3";

interface SortOption {
    title: string,
    value: string
}

export default defineComponent({
    name: "SortSelect",
    components: { UiSelect },
    props: {
        options: {
            type: Array as SortOption[],
            required: true
        },
        path: {
            type: String,
            required: true
        },
    },
    methods: {
        doSort(value: string) {
            this.sort = value;

            const currentQuery = Object.fromEntries(this.params.entries());

            const updatedQuery = { ...currentQuery, sort: this.sort };

            router.visit(route(this.path, updatedQuery));
        }
    },
    setup() {
        const params = new URLSearchParams(window.location.search);
        const sort = params.get('sort');

        return { sort, params };
    }
})
</script>



