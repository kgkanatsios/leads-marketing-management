<script setup>
import { RouterView } from 'vue-router'
import AppLayout from './components/AppLayout.vue'
import { useModalStore } from './stores/ModalStore'
import { useLeadStore } from './stores/LeadStore'
import LeadForm from './components/modals/LeadForm.vue'
import FloatingButton from './components/buttons/FloatingButton.vue'

const leadStore = useLeadStore()
leadStore.fetchLeads()

const modalStore = useModalStore()

function showAddMemberModal() {
  modalStore.initAddMemberModal(leadStore.addLead)
  modalStore.setModalIsShowing(true)
}
</script>

<template>
  <AppLayout>
    <RouterView />
  </AppLayout>

  <LeadForm
    v-if="modalStore.getModalIsShowing"
    v-model:firstName="modalStore.getModalProps.data.first_name"
    v-model:lastName="modalStore.getModalProps.data.last_name"
    v-model:email="modalStore.getModalProps.data.email"
    v-model:marketingConsent="modalStore.getModalProps.data.consent"
    :onCloseClickHandler="() => modalStore.setModalIsShowing(false)"
    :onSubmitHandler="() => modalStore.submitModal()"
  />

  <FloatingButton @click="showAddMemberModal()" />
</template>
