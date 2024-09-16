<template>
    <div class="relative cursor-pointer" @mouseover="showCart = true" @mouseleave="showCart = false">
        <CartIcon class="w-6 h-6 fill-gray-700"/>
        <div
            :class="['absolute -left-2 -top-3 rounded-full w-5 h-5 bg-red-700 text-white text-xs text-center flex', {'animate-bounce': animate}]">
            <span class="m-auto">{{ itemsCount }}</span>
        </div>
        <Suspense>
            <!-- of v-show? -->
            <SmallCartPopup v-if="showCart"/>
        </Suspense>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import CartIcon from "@/components/Icons/CartIcon.vue";
import { Link, usePage } from "@inertiajs/vue3";
import SmallCartPopup from "@/components/Cart/SmallCartPopup.vue";

export default defineComponent({
    name: "HeaderCartIcon",
    components: { SmallCartPopup, CartIcon, Link },

    data: () => ({
        animate: false,
        showCart: false,
    }),
    computed: {
        itemsCount() {
            const page = usePage();
            let count = page.props.cart?.items?.length ?? 0;
            if (count > 9) {
                count = '9+';
            }

            return count;
        }
    },

    watch: {
        itemsCount(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.animate = true;
                setTimeout(this.resetAnimation, 1000);
            }
        }
    },
    methods: {
        resetAnimation() {
            this.animate = false;
        }
    }
});
</script>
