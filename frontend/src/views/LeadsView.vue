<script setup>
import LoadingSpinner from '../components/LoadingSpinner.vue'
import LeadList from '../components/LeadList.vue'
import { useLeadStore } from '../stores/LeadStore'
const leadStore = useLeadStore()
</script>

<template>
  <div class="leads-list">
    <LoadingSpinner v-if="leadStore.getIsLoading" />
    <LeadList :list="leadStore.getLeads" v-else />
  </div>
</template>
