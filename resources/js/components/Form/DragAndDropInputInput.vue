<template>
    <label
        class="border-dashed border-2 rounded-lg w-full flex cursor-pointer flex"
        @dragover="dragover"
        @dragleave="dragleave"
        @drop="drop">
        <template v-if="fileUrl">
            <div class="bg-cover w-full h-full rounded-lg" :style="{backgroundImage: `url('${fileUrl}')`}"></div>
        </template>
        <template v-else>
            <div class="m-auto text-slate-500 text-sm italic">Place your file here!</div>
        </template>
        <input
            type="file"
            name="file"
            id="fileInput"
            class="hidden"
            @change="onChange"
            ref="file"
        />
    </label>
</template>
<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: "DragAndDropInput",
    data: () => ({
        isDragging: false,
        file: null,
    }),
    computed: {
        fileUrl() {
            return this.file ? URL.createObjectURL(this.file) : null;
        }
    },
    methods: {
        onChange() {
            this.file = this.$refs.file.files[0];
        },
        dragover(e) {
            e.preventDefault();
            this.isDragging = true;
        },
        dragleave() {
            this.isDragging = false;
        },
        drop(e) {
            e.preventDefault();
            this.$refs.file.files = e.dataTransfer.files;
            this.onChange();
            this.isDragging = false;
        },
    },
    props: {
        modelValue: {
            type: String,
            required: true
        },
    }
})
</script>



