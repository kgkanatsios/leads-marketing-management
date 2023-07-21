<script setup>
import { RouterView } from 'vue-router'
import AppLayout from './components/AppLayout.vue'
import { useModalStore } from './stores/ModalStore'
import { useLeadStore } from './stores/LeadStore'
import LeadForm from './components/modals/LeadForm.vue'
import LeadDelete from './components/modals/LeadDelete.vue'
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

  <component
    :is="modalStore.getModalComponent == 'LeadDelete' ? LeadDelete : LeadForm"
    v-if="modalStore.getModalIsShowing"
    :isLoading="modalStore.getModalIsLoading"
    :messages="modalStore.getModalMessages"
    v-model:firstName="modalStore.getModalProps.data.first_name"
    v-model:lastName="modalStore.getModalProps.data.last_name"
    v-model:email="modalStore.getModalProps.data.email"
    v-model:marketingConsent="modalStore.getModalProps.data.consent"
    :onCloseClickHandler="() => modalStore.setModalIsShowing(false)"
    :onSubmitHandler="() => modalStore.submitModal()"
  />

  <FloatingButton @click="showAddMemberModal()" />
</template>
