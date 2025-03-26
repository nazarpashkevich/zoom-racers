<script lang="ts">
import { defineComponent } from 'vue'
import { Chart, Grid, Line } from "vue3-charts";
import DashboardService from "@/services/dashboard.service";

export default defineComponent({
    name: "NewUsersChart",
    components: { Line, Grid, Chart },
    data: () => ({
        data: []
    }),
    methods: {
        async initData() {
            this.data = await DashboardService.newUsers();
        }
    },
    mounted() {
        this.initData();
    }
})
</script>

<template>
    <Chart :data="data" />

</template>
