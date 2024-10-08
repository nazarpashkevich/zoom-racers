<template>
    <form @submit.prevent="onSubmit" class="flex gap-12">
        <div class="w-1/2">
            <DragAndDropInputInput v-model="form.picture" class="h-96"/>
            <InputError class="mt-2" :message="form.errors.picture"/>
        </div>
        <div class="w-1/2 space-y-6">
            <div>
                <InputLabel for="title" value="Title"/>
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />
                <InputError class="mt-2" :message="form.errors.title"/>
            </div>
            <div>
                <InputLabel for="date" value="Date"/>
                <VueDatePicker
                    v-model="form.date"
                    class="mt-1"
                    required
                    :teleport="true"
                    :auto-position="false"
                    range
                />
                <InputError class="mt-2" :message="form.errors.date"/>
            </div>
            <div>
                <InputLabel for="language" value="Language"/>
                <UiSelect
                    id="language"
                    class="mt-1 block w-full"
                    v-model="form.language"
                    :options="languages"
                    required
                />
                <InputError class="mt-2" :message="form.errors.language"/>
            </div>
            <div>
                <InputLabel for="category" value="Category"/>
                <UiSelect
                    id="category"
                    class="mt-1 block w-full"
                    v-model="form.category"
                    :options="categories"
                    required
                />
                <InputError class="mt-2" :message="form.errors.category"/>
            </div>
            <div>
                <InputLabel for="platform" value="Platform"/>
                <UiSelect
                    id="platform"
                    class="mt-1 block w-full"
                    v-model="form.platform"
                    :options="platforms"
                    required
                />
                <InputError class="mt-2" :message="form.errors.platform"/>
            </div>
            <div>
                <InputLabel for="link" value="Link"/>
                <TextInput
                    id="link"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.link"
                    required
                    autocomplete="link"
                />
                <InputError class="mt-2" :message="form.errors.link"/>
            </div>
            <div>
                <InputLabel for="price" value="Price"/>
                <TextInput
                    id="price"
                    type="number"
                    class="mt-1 block w-full"
                    v-model="form.price"
                    required
                    autocomplete="price"
                />
                <InputError class="mt-2" :message="form.errors.price"/>
            </div>
            <div>
                <InputLabel for="description" value="Description"/>
                <TextAreaInput
                    id="description"
                    class="mt-1 block w-full "
                    v-model="form.description"
                    required
                />
                <InputError class="mt-2" :message="form.errors.description"/>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </div>
    </form>
</template>
<script lang="ts">
import { defineComponent } from 'vue'
import { Link, useForm } from "@inertiajs/vue3";
import InputLabel from "@/components/Form/InputLabel.vue";
import TextInput from "@/components/Form/TextInput.vue";
import InputError from "@/components/Form/InputError.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import DragAndDropInputInput from "@/components/Form/DragAndDropInputInput.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import UiSelect from "@/components/Form/UiSelect.vue";
import TextAreaInput from "@/components/Form/TextAreaInput.vue";
import EventService from "@/services/EventService";
import EventModel from "@/contracts/events/EventModel";

export default defineComponent({
    name: "EditEventForm",
    components: {
        TextAreaInput,
        UiSelect,
        DragAndDropInputInput,
        PrimaryButton,
        InputError,
        TextInput,
        InputLabel,
        Link,
        VueDatePicker
    },
    data: () => ({}),
    methods: {
        onSubmit() {
            this.form.transform((data) => ({
                ...data,
                start: data.date[0],
                end: data.date[1]
            }));

            this.event?.id ? this.form.put(route('personal-events.update', this.event.id))
                : this.form.post(route('personal-events.store'));
        }
    },
    props: {
        event: {
            type: Object as EventModel,
            required: false
        }
    },
    async setup(props) {
        const service = EventService.make();

        const [languages, categories, platforms] = await Promise.all([
            service.languages(),
            service.categories(),
            service.platforms(),
        ]);

        const event = props.event as EventModel;

        const form = useForm({
            picture: event?.picture ?? null,
            title: event?.title ?? '',
            date: event ? [event.start, event.end] : null,
            language: event?.language.value ?? '',
            category: event?.category.value ?? '',
            platform: event?.platform.value ?? '',
            link: event?.link ?? '',
            price: event?.price.value ?? '',
            description: event?.description ?? '',
        });

        return { form, languages, categories, platforms };
    }
})
</script>
