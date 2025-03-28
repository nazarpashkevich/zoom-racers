<script lang="ts">
import { defineComponent } from 'vue'
import { Chart, Grid, Line } from "vue3-charts";
import { StatisticData } from "@/types/dashboard";

export default defineComponent({
    name: "LineChart",
    components: { Line, Grid, Chart },
    data: () => ({
        margin: {
            left: 0,
            top: 20,
            right: 20,
            bottom: 0
        }
    }),
    props: {
        title: {
            type: String,
            required: true,
        },
        data: {
            type: Array<StatisticData>,
            default: () => ([])
        }
    }
})
</script>

<template>
    <div class="">
        <p class="text-xl font-semibold pl-4">{{ title }}</p>
        <Chart
            :data="data"
            :margin="margin"
            :size="{ width: 500, height: 250 }"
            class="p-4">

            <template #layers>
                <Grid strokeDasharray="2,2"/>
                <Line :dataKeys="['key', 'value']"/>
            </template>

        </Chart>
    </div>

</template>
