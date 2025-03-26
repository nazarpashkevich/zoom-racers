<template>
    <div class="border border-gray-300 rounded-lg flex divide-x justify-around">
        <ListViewIcon class="w-10 h-3.5 m-auto" :class="{'fill-slate-500 cursor-pointer': !isList }"
                      @click="() => changeView(listViewMode.List)"
        />
        <GridViewIcon class="w-10 h-3.5 m-auto" :class="{'fill-slate-500 cursor-pointer': isList }"
                      @click="() => changeView(listViewMode.Grid)"
        />
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import ListViewIcon from "@/components/Icons/ListViewIcon.vue";
import GridViewIcon from "@/components/Icons/GridViewIcon.vue";
import { ListViewModeEnum } from "@/enums/list-view-mode.enum";


export default defineComponent({
    name: "ViewChanger",
    components: { GridViewIcon, ListViewIcon },
    data: () => ({
        listViewMode: ListViewModeEnum,
    }),
    props: {
        modelValue: {
            type: String as ListViewModeEnum,
            default: 'list'
        }
    },
    computed: {
        isList() {
            return this.modelValue === ListViewModeEnum.List;
        }
    },
    methods: {
        changeView(view: ListViewModeEnum) {
            this.$emit('update:modelValue', view);
        }
    }
})
</script>



