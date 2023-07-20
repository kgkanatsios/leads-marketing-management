<script setup>
import BackgroundOverlay from './BackgroundOverlay.vue'
import ModalContainer from './ModalContainer.vue'
import PrimaryButton from '../buttons/PrimaryButton.vue'
import DangerButton from '../buttons/DangerButton.vue'
import InputText from '../form-fields/InputText.vue'
import InputCheckbox from '../form-fields/InputCheckbox.vue'

defineProps({
  onCloseClickHandler: {
    type: Function,
    required: true
  },
  onSubmitHandler: {
    type: Function,
    required: true
  },
  firstName: String,
  lastName: String,
  email: String,
  marketingConsent: Boolean
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
  </ModalContainer>
</template>
