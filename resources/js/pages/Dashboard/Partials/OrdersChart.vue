<script lang="ts">
import { defineComponent } from 'vue'
import { Chart, Grid, Line } from "vue3-charts";
import DashboardService from "@/services/dashboard.service";
import LineChart from "@/components/Chart/LineChart.vue";

export default defineComponent({
    name: "OrdersChart",
    components: { LineChart, Line, Grid, Chart },
    data: () => ({
        data: []
    }),
    methods: {
        async initData() {
            this.data = await DashboardService.orders();
        }
    },
    mounted() {
        this.initData();
    }
})
</script>

<template>
    <LineChart :data="data" title="Orders"/>
</template>
