<script setup>
import BackgroundOverlay from './BackgroundOverlay.vue'
import ModalContainer from './ModalContainer.vue'
import PrimaryButton from '../buttons/PrimaryButton.vue'
import DangerButton from '../buttons/DangerButton.vue'
import InputText from '../form-fields/InputText.vue'
import InputCheckbox from '../form-fields/InputCheckbox.vue'
import LoadingSpinner from '../LoadingSpinner.vue'
import SuccessAlert from '../alerts/SuccessAlert.vue'
import DangerAlert from '../alerts/DangerAlert.vue'

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
        <h3 class="text-xl font-semibold text-gray-900">{{ $t('message.lead.modal.title') }}</h3>
        <h4 class="text-xs text-gray-700">{{ $t('message.lead.modal.subtitle') }}</h4>
      </div>
    </template>

    <component
      v-for="(message, index) in messages"
      :key="index"
      :is="message.component == 'success' ? SuccessAlert : DangerAlert"
    >
      <span>{{ message.translation ? $t(message.message) : message.message }}</span>
    </component>

    <InputText
      :id="'first_name'"
      :label="$t('message.lead.form.field.firstName')"
      :name="'first_name'"
      :value="firstName"
      @input="$emit('update:firstName', $event.target.value)"
    />

    <InputText
      :id="'last_name'"
      :label="$t('message.lead.form.field.lastName')"
      :name="'last_name'"
      :value="lastName"
      @input="$emit('update:lastName', $event.target.value)"
    />

    <InputText
      :id="'email'"
      :label="$t('message.lead.form.field.email')"
      :name="'email'"
      :value="email"
      @input="$emit('update:email', $event.target.value)"
    />

    <InputCheckbox
      :id="'marketing-consent'"
      :label="$t('message.lead.form.field.marketingConsent')"
      :checked="marketingConsent"
      @input="$emit('update:marketingConsent', $event.target.checked)"
    />

    <template #footer-content>
      <DangerButton @click="onCloseClickHandler" :text="$t('message.lead.button.cancel')" />
      <PrimaryButton @click="onSubmitHandler" :text="$t('message.lead.button.subscribe')" />
    </template>
    <template #outer-content>
      <LoadingSpinner v-if="isLoading" />
    </template>
  </ModalContainer>
</template>
