<script setup>
import { RouterView } from 'vue-router'
import AppLayout from './components/AppLayout.vue'

import { useLeadStore } from './stores/LeadStore'
const leadStore = useLeadStore()
leadStore.fetchLeads()
</script>

<template>
  <AppLayout>
    <RouterView />
  </AppLayout>
</template>
