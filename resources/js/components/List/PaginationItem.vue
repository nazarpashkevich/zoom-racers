<template>
    <div :class="classes" class="border px-3 py-1.5 rounded-lg text-center min-w-10" v-on:click="navigate">{{
            page
        }}
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import { router } from "@inertiajs/vue3";

export default defineComponent({
    name: "PaginationItem",
    computed: {
        classes() {
            return this.active ? 'bg-gray-800 text-white' :
                ' bg-white cursor-pointer hover:bg-gray-800 hover:text-white';
        }
    },
    props: {
        active: {
            type: Boolean,
            required: true
        },
        path: {
            type: String,
            required: true
        },
        page: {
            type: Number,
            required: true
        },
        pageName: {
            type: String,
            default: 'page'
        }
    },
    methods: {
        navigate() {
            const params = new URLSearchParams(window.location.search)

            params.set(this.pageName, this.page);

            router.visit(this.path, { data: params })
        }
    }
});
</script>
