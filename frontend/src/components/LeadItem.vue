<script setup>
import { computed, ref } from 'vue'
import { useModalStore } from '../stores/ModalStore'
import { useLeadStore } from '../stores/LeadStore'
import PrimaryButton from './buttons/PrimaryButton.vue'
import InputCheckbox from './form-fields/InputCheckbox.vue'

const props = defineProps({
  item: {
    type: Object,
    required: true
  }
})

const leadStore = useLeadStore()
const modalStore = useModalStore()

const leadId = ref(props.item.data.lead_id)
const email = ref(props.item.data.attributes.email)
const firstName = ref(props.item.data.attributes.first_name)
const lastName = ref(props.item.data.attributes.last_name)
const marketingConsent = ref(props.item.data.attributes.consent)

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
</script>

<template>
  <li class="py-3 sm:py-4">
    <div class="flex items-center space-x-4">
      <div class="flex-shrink-0">
        <div
          class="mr-2 relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-100 rounded-full"
        >
          <span class="font-medium text-gray-600">{{ avatarLetters }}</span>
        </div>
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
        :checked="marketingConsent"
        disabled
        :id="'marketing-consent-' + leadId"
        :label="$t('message.lead.marketingConsent')"
      />
      <div class="inline-flex items-center justify-center font-semibold text-gray-900">
        <PrimaryButton @click="showEditMemberModal" :text="$t('message.lead.button.edit')" />
      </div>
    </div>
  </li>
</template>
