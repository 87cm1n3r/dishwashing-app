<template>
  <div class="
      p-4
      m-4
      mb-8
      sm:m-0
      col-span-7
      sm:col-span-2
      rounded-lg
      border-2 border-dashed border-gray-300
      flex flex-col
      place-self-stretch
    ">
    <div class="grid grid-cols-3 sm:grid-cols-2 gap-4 flex-1 items-start">
      <TransitionGroup>
      <UtensilCard
        v-for="utensil in utensils"
        :key="utensil.id"
        :id="utensil.id"
        :name="utensil.name"
        :quantity="utensil.used"
        :image_url="utensil.image_url"
        @click="$emit('removed', utensil)"
        class="hover:bg-red-200"
      ></UtensilCard>
      </TransitionGroup>
    </div>
    <button class="bg-indigo-300 rounded-lg text-white px-4 py-2 mt-4 w-full" @click.prevent="use">Use</button>

  </div>
</template>

<script setup>
import UtensilCard from "@/Components/UtensilCard.vue";
import { Inertia } from '@inertiajs/inertia';
import { store } from "../store.js";

defineProps({
  utensils: {
    type: Object,
    required: true,
  },
});
defineEmits({
  removed: {
    type: Object,
    required: true,
  },
});

function use() {
  Inertia.post('/utensils/use', {
    utensils: store.basket,
  });
  store.basket = [];
}
</script>

<style>
.v-enter-from,
.v-leave-to {
  opacity: 0;
}

</style>