<script setup>
import LeadItem from './LeadItem.vue'
defineProps({
  list: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <ul class="max-w-2xl mx-auto divide-y divide-gray-200">
    <LeadItem v-for="(item, index) in list" :item="item" :key="index" />
  </ul>
</template>
