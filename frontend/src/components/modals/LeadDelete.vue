<script setup>
import BackgroundOverlay from './BackgroundOverlay.vue'
import ModalContainer from './ModalContainer.vue'
import PrimaryButton from '../buttons/PrimaryButton.vue'
import DangerButton from '../buttons/DangerButton.vue'
import LoadingSpinner from '../LoadingSpinner.vue'

defineProps({
  onCloseClickHandler: {
    type: Function,
    required: true
  },
  onSubmitHandler: {
    type: Function,
    required: true
  },
  firstName: {
    type: String,
    default: ''
  },
  lastName: {
    type: String,
    default: ''
  },
  email: {
    type: String,
    default: ''
  },
  marketingConsent: {
    type: Boolean,
    default: false
  },
  isLoading: {
    type: Boolean,
    required: true
  },
  messages: {
    type: Array,
    default: () => []
  }
})

defineEmits(['update:firstName', 'update:lastName', 'update:email', 'update:marketingConsent'])
</script>

<template>
  <BackgroundOverlay :onCloseClickHandler="onCloseClickHandler" />
  <ModalContainer :onCloseClickHandler="onCloseClickHandler">
    <template #header-title>
      <div>
        <h3 class="text-xl font-semibold text-gray-900">
          {{ $t('message.lead.modal.titleDelete', { leadEmail: email }) }}
        </h3>
      </div>
    </template>

    <span>
      {{ $t('message.lead.modal.textDelete', { leadEmail: email }) }}
    </span>

    <template #footer-content>
      <DangerButton @click="onCloseClickHandler" :text="$t('message.lead.button.cancel')" />
      <PrimaryButton @click="onSubmitHandler" :text="$t('message.lead.button.delete')" />
    </template>
    <template #outer-content>
      <LoadingSpinner v-if="isLoading" />
    </template>
  </ModalContainer>
</template>
