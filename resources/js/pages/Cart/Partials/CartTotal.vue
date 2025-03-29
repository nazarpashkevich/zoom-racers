<template>
  <span class="text-xl"
    >Total: <span class="font-semibold">{{ formatPrice(amount) }}</span>
  </span>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import { formatPrice } from '@/helpers/money.helpers';
import { Price } from '@/types/common';

export default defineComponent({
  name: 'CartTotal',
  methods: { formatPrice },
  components: {},
  props: {
    amount: {
      type: Object as Price,
      required: true,
    },
  },
});
</script>
