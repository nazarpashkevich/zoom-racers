<template>
    <div
        class="flex gap-12 hover:bg-gray-50 rounded-lg py-4 px-6 w-96 border border-slate-200 shadow-sm pr-8 relative">
        <div class="w-1/3">
            <div class="bg-contain bg-center rounded-full w-24 h-24"
                 :style="{backgroundImage: `url('https://aobnutrition.ie/cdn/shop/files/on-gold-whey-5lbs-gs5-shaker-aug24a_1080x.jpg?v=1724070923')`}"></div>
        </div>
        <div class="w-2/3">
            <div class="flex flex-col gap-2">
                <div class="text-md font-semibold text-left">Gold Whey Protein</div>
                <div class="text-xs text-gray-500">12.12.2012 12:12 - 12:50</div>
                <div class="flex gap-4">
                    <div class="text-xs rounded-lg px-4 py-1 bg-purple-50 text-purple-700 inline-block">English</div>
                    <div class="text-xs rounded-lg px-4 py-1 bg-yellow-50 text-orange-500 inline-block">Handmade</div>
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

export default defineComponent({
    name: "EventSmallCard",
    components: { Dropdown, DropdownLink, ThreeDotsIcon, LocationIcon, BasketIcon, PrimaryButton, Link },
    computed: {
        hasActionSlot() {
            return !!this.$slots.actions;
        }
    }
})
</script>
