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
            ref="fileInput"
        />
    </label>
</template>
<script lang="ts">
import { defineComponent, ref } from 'vue'

export default defineComponent({
    name: "DragAndDropInput",
    data: () => ({
        isDragging: false,
    }),
    computed: {
        fileUrl() {
            return this.file ?? null;
        }
    },
    methods: {
        onChange() {
            this.file = URL.createObjectURL(this.$refs.fileInput.files[0]);
            this.$emit('update:modelValue', this.$refs.fileInput.files[0]);
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
        modelValue: {},
    },
    setup(props) {
        const file = ref('');

        if (props.modelValue) {
            file.value = props.modelValue;
        }
        console.log(file);
        console.log(props.modelValue);
        return { file };
    }
})
</script>



