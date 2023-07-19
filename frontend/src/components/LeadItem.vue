<script setup>
import { ref, computed } from 'vue'
import PrimaryButton from './buttons/PrimaryButton.vue'
import InputTextbox from './form-fields/InputTextbox.vue'

const props = defineProps({
  item: {
    type: Object,
    required: true
  }
})

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
      <InputTextbox
        :checked="marketingConsent"
        disabled
        :id="'marketing-consent-' + leadId"
        :label="$t('message.lead.marketingConsent')"
      />
      <div class="inline-flex items-center justify-center font-semibold text-gray-900">
        <PrimaryButton @click="console.log(item)" :text="$t('message.lead.button.edit')" />
      </div>
    </div>
  </li>
</template>
