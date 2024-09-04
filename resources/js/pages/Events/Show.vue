<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex py-12 px-32">
                    <div class="w-1/2">
                        <div class="bg-contain bg-center h-96 rounded-md mx-auto w-2/3"
                             :style="{backgroundImage: `url('https://aobnutrition.ie/cdn/shop/files/on-gold-whey-5lbs-gs5-shaker-aug24a_1080x.jpg?v=1724070923')`}"></div>
                    </div>
                    <div class="w-1/2 px-8">
                        <h1 class="text-4xl font-semibold text-left mb-4">Gold Whey Protein</h1>
                        <div class="ml-4">
                            <div class="text-xs text-gray-500 mb-8">12.12.2012 12:12 - 12:50</div>
                            <div class="flex flex-col gap-4 mb-8">
                                <div class="flex gap-2 items-center">
                                    <span class="text-sm text-gray-500">Author: </span>
                                    <div
                                        class="border rounded-xl text-xs text-slate-800 py-2 px-4 shadow-sm flex
                                 items-center gap-2 font-semibold cursor-pointer hover:bg-gray-50">
                                        <div class="bg-contain bg-center h-6 w-6 rounded-full hover:text-indigo-900"
                                             :style="{backgroundImage: `url('https://aobnutrition.ie/cdn/shop/files/on-gold-whey-5lbs-gs5-shaker-aug24a_1080x.jpg?v=1724070923')`}"></div>
                                        Some author name
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="text-xs rounded-lg px-4 py-1 bg-purple-50 text-purple-700 inline-block">
                                        English
                                    </div>
                                    <div class="text-xs rounded-lg px-4 py-1 bg-yellow-50 text-orange-500 inline-block">
                                        Handmade
                                    </div>
                                    <div
                                        class="text-xs rounded-lg px-4 py-1 bg-blue-50 text-blue-500 inline-block flex
                                     gap-2 items-center max-w-48">
                                        <LocationIcon class="w-3 h-3 fill-blue-500"/>
                                        Zoom
                                    </div>
                                </div>
                            </div>
                            <div class="flex mb-8">
                                <div class="text-2xl font-semibold">$1222.22</div>
                                <PrimaryButton class="ml-auto">
                                    <div class="flex gap-2 justify-center w-full">
                                        <BasketIcon class="fill-white w-4 h-4"/>
                                        Add to Card
                                    </div>
                                </PrimaryButton>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="font-semibold text-xl">Description:</div>
                                <p class="text-sm text-gray-500 pl-4">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing
                                    elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                    deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import LocationIcon from "@/components/Icons/LocationIcon.vue";
import BasketIcon from "@/components/Icons/BasketIcon.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import { ListViewMode } from "@/enums/ListViewMode";

export default defineComponent({
    components: {
        AuthenticatedLayout,
        LocationIcon,
        BasketIcon,
        PrimaryButton,
        Head
    },
    data() {
        return {
            viewMode: ListViewMode.List
        };
    }
});
</script>
