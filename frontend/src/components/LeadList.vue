<script setup>
import { computed } from 'vue'
import LeadItem from './LeadItem.vue'
import DarkAlert from './alerts/DarkAlert.vue'

const props = defineProps({
  list: {
    type: Array,
    required: true
  }
})

const listLength = computed(() => {
  return props.list.length
})
</script>

<template>
  <DarkAlert class="mb-6 text-center">
    <p>{{ $t('message.lead.numOfLeads', { leadsNum: listLength }) }}</p>
  </DarkAlert>
  <ul class="max-w-2xl mx-auto divide-y divide-gray-200">
    <LeadItem v-for="(item, index) in list" :item="item" :key="index" />
  </ul>
</template>
