<script setup>
import { computed, toRef } from 'vue'
import { useModalStore } from '../stores/ModalStore'
import { useLeadStore } from '../stores/LeadStore'
import PrimaryButton from './buttons/PrimaryButton.vue'
import DangerButton from './buttons/DangerButton.vue'
import InputCheckbox from './form-fields/InputCheckbox.vue'

const props = defineProps({
  item: {
    type: Object,
    required: true
  }
})

const leadStore = useLeadStore()
const modalStore = useModalStore()

const leadId = toRef(() => props.item.data.lead_id)
const email = toRef(() => props.item.data.attributes.email)
const firstName = toRef(() => props.item.data.attributes.first_name)
const lastName = toRef(() => props.item.data.attributes.last_name)
const marketingConsent = toRef(() => props.item.data.attributes.consent)
const needsSync = toRef(() => props.item.data.attributes.needs_sync)

const fullName = computed(() => {
  return firstName.value + ' ' + lastName.value
})

const avatarLetters = computed(() => {
  return firstName.value.charAt(0) + lastName.value.charAt(0)
})

function showEditMemberModal() {
  modalStore.initEditMemberModal(
    {
      lead_id: leadId.value,
      first_name: firstName.value,
      last_name: lastName.value,
      email: email.value,
      consent: marketingConsent.value
    },
    leadStore.updateLead
  )
  modalStore.setModalIsShowing(true)
}

function showDeleteMemberModal() {
  modalStore.initDeletMemberModal(
    {
      lead_id: leadId.value,
      first_name: firstName.value,
      last_name: lastName.value,
      email: email.value,
      consent: marketingConsent.value
    },
    leadStore.deleteLead
  )
  modalStore.setModalIsShowing(true)
}
</script>

<template>
  <li class="py-3 sm:py-4">
    <div class="flex items-center space-x-4">
      <div class="flex-shrink-0 relative">
        <div
          class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-100 rounded-full"
        >
          <span class="font-medium text-gray-600">{{ avatarLetters }}</span>
        </div>
        <span
          v-if="needsSync"
          class="absolute bottom-0 right-0 transform translate-y-1/4 translate-x-1/4 w-3.5 h-3.5 bg-yellow-400 border-2 border-white rounded-full"
        ></span>
      </div>
      <div class="flex-1 min-w-0">
        <p class="text-sm font-medium text-gray-900 truncate">
          {{ fullName }}
        </p>
        <p class="text-sm text-gray-500 truncat">
          {{ email }}
        </p>
      </div>
      <InputCheckbox
        :id="'marketing-consent-' + leadId"
        :label="$t('message.lead.marketingConsent')"
        :checked="marketingConsent"
        disabled
      />
      <div class="inline-flex items-center justify-center font-semibold text-gray-900">
        <PrimaryButton @click="showEditMemberModal" :text="$t('message.lead.button.edit')" />
      </div>
      <div class="inline-flex items-center justify-center font-semibold text-gray-900">
        <DangerButton @click="showDeleteMemberModal" :text="$t('message.lead.button.delete')" />
      </div>
    </div>
  </li>
</template>
