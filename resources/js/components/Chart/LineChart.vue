<script lang="ts">
import { defineComponent } from 'vue'
import { Chart, Grid, Line } from "vue3-charts";

export default defineComponent({
    name: "LineChart",
    components: { Line, Grid, Chart },
    computed: {
        chartData(): Array {
            return Object.entries(this.data).map(([key, value]) => ({
                label: key,
                value: value
            }));
        }
    },
    props: {
      title: {
          type: String,
          required: true,
      },
      data: {
          type: Object as Object<string, number>,
          default: () => ({})
      }
    }
})
</script>

<template>
    <div class="">
        <p class="text-2xl font-semibold pl-4">{{ title }}</p>
    <Chart
        :size="{ width: 500, height: 250 }"
        :data="chartData"
        class="p-4">

        <template #layers>
            <Grid strokeDasharray="2,2" />
            <Line :dataKeys="['label', 'value']" />
        </template>

    </Chart>
    </div>

</template>
