<template>
  <form class="flex max-md:flex-col gap-12" @submit.prevent="onSubmit">
    <div class="md:w-1/2">
      <DragAndDropInputInput v-model="form.picture" class="h-96"/>
      <InputError :message="form.errors.picture" class="mt-2"/>
    </div>
    <div class="md:w-1/2 space-y-6">
      <div>
        <InputLabel for="title" value="Title"/>
        <TextInput
          id="title"
          v-model="form.title"
          autocomplete="title"
          autofocus
          class="mt-1 block w-full"
          required
          type="text"
        />
        <InputError :message="form.errors.title" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="date" value="Date"/>
        <VueDatePicker
          v-model="form.date"
          :auto-position="false"
          :teleport="true"
          class="mt-1"
          range
          required
        />
        <InputError :message="form.errors.date" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="language" value="Language"/>
        <UiSelect
          id="language"
          v-model="form.language"
          :options="languages"
          class="mt-1 block w-full"
          required
        />
        <InputError :message="form.errors.language" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="category" value="Category"/>
        <UiSelect
          id="category"
          v-model="form.category"
          :options="categories"
          class="mt-1 block w-full"
          required
        />
        <InputError :message="form.errors.category" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="platform" value="Platform"/>
        <UiSelect
          id="platform"
          v-model="form.platform"
          :options="platforms"
          class="mt-1 block w-full"
          required
        />
        <InputError :message="form.errors.platform" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="link" value="Link"/>
        <TextInput
          id="link"
          v-model="form.link"
          autocomplete="link"
          class="mt-1 block w-full"
          required
          type="text"
        />
        <InputError :message="form.errors.link" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="price" value="Price"/>
        <TextInput
          id="price"
          v-model="form.price"
          autocomplete="price"
          class="mt-1 block w-full"
          required
          type="number"
        />
        <InputError :message="form.errors.price" class="mt-2"/>
      </div>
      <div>
        <InputLabel for="description" value="Description"/>
        <TextAreaInput
          id="description"
          v-model="form.description"
          class="mt-1 block w-full"
          required
        />
        <InputError :message="form.errors.description" class="mt-2"/>
      </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
            Saved.
          </p>
        </Transition>
      </div>
    </div>
  </form>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/components/Form/InputLabel.vue';
import TextInput from '@/components/Form/TextInput.vue';
import InputError from '@/components/Form/InputError.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import DragAndDropInputInput from '@/components/Form/DragAndDropInputInput.vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import UiSelect from '@/components/Form/UiSelect.vue';
import TextAreaInput from '@/components/Form/TextAreaInput.vue';
import EventService from '@/services/event.service';
import { EventModel } from '@/types/event';

export default defineComponent({
  name: 'EditEventForm',
  components: {
    TextAreaInput,
    UiSelect,
    DragAndDropInputInput,
    PrimaryButton,
    InputError,
    TextInput,
    InputLabel,
    Link,
    VueDatePicker,
  },
  data: () => ({}),
  methods: {
    onSubmit() {
      this.form.transform((data) => ({
        ...data,
        start: data.date[0],
        end: data.date[1],
      }));

      this.event?.id
        ? this.form.put(route('personal-events.update', this.event.id))
        : this.form.post(route('personal-events.store'));
    },
  },
  props: {
    event: {
      type: Object as EventModel,
      required: false,
    },
  },
  async setup(props) {
    const [languages, categories, platforms] = await Promise.all([
      EventService.languages(),
      EventService.categories(),
      EventService.platforms(),
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
  },
});
</script>
