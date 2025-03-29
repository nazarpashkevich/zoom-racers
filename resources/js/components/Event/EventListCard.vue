<template>
  <Link
    :href="route('events.show', event.id)"
    class="flex gap-4 hover:bg-gray-50 py-8 px-6 h-72 cursor-pointer"
  >
    <div class="w-1/3 px-2 md:px-6">
      <div
        :style="{ backgroundImage: `url('${event.picture}')` }"
        class="bg-cover bg-center rounded-md w-full h-full"
      ></div>
    </div>
    <div class="flex max-md:flex-col w-2/3">
      <div class="md:w-1/2 flex flex-col gap-2">
        <div class="text-xl font-semibold text-left hover:text-indigo-900">
          {{ event.title }}
        </div>
        <div class="text-xs text-gray-500">{{ resource.date() }}</div>
        <div class="text-md font-semibold">{{ formatPrice(event.price) }}</div>
        <div class="flex gap-4">
          <div
            class="text-xs rounded-lg px-4 py-1 bg-purple-50 text-purple-700 inline-block"
          >
            {{ event.language.title }}
          </div>
          <div
            class="text-xs rounded-lg px-4 py-1 bg-yellow-50 text-orange-500 inline-block"
          >
            {{ event.category.title }}
          </div>
        </div>
        <div
          class="text-xs rounded-lg px-4 py-1 bg-blue-50 text-blue-500 inline-block mb-6 flex gap-2 items-center max-w-48"
        >
          <LocationIcon class="w-3 h-3 fill-blue-500"/>
          {{ event.platform.title }}
        </div>
      </div>
      <div class="md:w-1/2 text-right">
        <template v-if="!hasActionSlot">
          <AddToCartButton
            :product-id="event.id"
            :type="CartProductType.Event"
            class="ml-auto"
          />
        </template>
        <slot v-else name="actions"/>
      </div>
    </div>
  </Link>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import BasketIcon from '@/components/Icons/BasketIcon.vue';
import LocationIcon from '@/components/Icons/LocationIcon.vue';
import { Link } from '@inertiajs/vue3';
import EventResource from '@/resources/event.resource';
import { formatPrice } from '@/helpers/money.helpers';
import { EventModel } from '@/types/event';
import AddToCartButton from "@/components/Cart/AddToCartButton.vue";
import { CartProductTypeEnum } from "@/enums/cart-product-type.enum";

export default defineComponent({
  name: 'EventListCard',
  methods: { formatPrice },
  components: { AddToCartButton, LocationIcon, BasketIcon, PrimaryButton, Link },
  computed: {
    hasActionSlot() {
      return !!this.$slots.actions;
    },
    CartProductType() {
      return CartProductTypeEnum;
    },
  },
  props: {
    event: {
      type: Object as EventModel,
      required: true,
    },
  },
  setup(props) {
    const resource = new EventResource(props.event);

    return { resource, formatPrice };
  },
});
</script>
