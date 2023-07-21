<script setup>
import { ref } from 'vue'

import SuccessAlert from '../components/alerts/SuccessAlert.vue'
import DarkAlert from '../components/alerts/DarkAlert.vue'
import DangerAlert from '../components/alerts/DangerAlert.vue'

import PrimaryButton from '../components/buttons/PrimaryButton.vue'
import DangerButton from '../components/buttons/DangerButton.vue'

import InputText from '../components/form-fields/InputText.vue'
import InputCheckbox from '../components/form-fields/InputCheckbox.vue'

const input = ref('')
const checkbox = ref(false)

function updateCheckbox(value){
  checkbox.value = value
}
</script>

<template>
  <h1 class="inline-block mb-2 text-3xl font-bold tracking-tight text-gray-900">
    Leads management system by Konstantinos Gkanatsios
  </h1>
  <div class="mb-6 text-gray-600">
    This is the VueJS SPA for the Leads management system. Uses the Laravel Backend API to retrieve, add, update and delete Leads. 
  </div>

  <h2 class="inline-block mb-2 text-xl font-bold tracking-tight text-gray-900">Packages</h2>
  <div class="mb-6 text-gray-600">
    In order to cover our project needs, I used some extra NPM packages in VueJS SPA:
    <ul class="space-y-1 list-disc list-inside">
      <li><strong>Axios</strong>: I used Axios as HTTP Client to interact with the Larave API.</li>
      <li><strong>Penia</strong>: I used Penia for the state management.</li>
      <li><strong>Vue I18n</strong>: I used Vue I18n to manage locale messages.</li>
      <li><strong>Vue Router</strong>: I used Vue Router as router for the SPA.</li>
    </ul>
  </div>

  <h2 class="inline-block mb-2 text-xl font-bold tracking-tight text-gray-900">Styles</h2>
  <div class="mb-6 text-gray-600">
    For the styling of this SPA, I used the <span class="font-bold text-cyan-700">Tailwind CSS</span>.
  </div>

  <h2 class="inline-block mb-2 text-xl font-bold tracking-tight text-gray-900">UI components</h2>
  <div class="mb-6 text-gray-600">
    <h3 class="inline-block mb-2 text-md font-bold tracking-tight text-gray-900">Alerts</h3>
    <div class="mb-4">
      <SuccessAlert class="mb-2">
        <span class="font-medium">Success alert!</span> Lorem, ipsum dolor sit amet consectetur
        adipisicing elit.
      </SuccessAlert>

      <DarkAlert class="mb-2">
        <span class="font-medium">Dark alert!</span> Lorem, ipsum dolor sit amet consectetur
        adipisicing elit.
      </DarkAlert>

      <DangerAlert class="mb-2">
        <span class="font-medium">Danger alert!</span> Lorem, ipsum dolor sit amet consectetur
        adipisicing elit.
      </DangerAlert>
    </div>

    <h3 class="inline-block mb-2 text-md font-bold tracking-tight text-gray-900">Buttons</h3>
    <div class="mb-4">
      <div class="mb-2">
        <PrimaryButton text="Primary Button" class="mr-2" />
        <DangerButton text="Danger Button" class="mr-2" />
      </div>
      <div>
        Also, we have a floating button. You can see it on every page in the bottom right corner.
      </div>
    </div>

    <h3 class="inline-block mb-2 text-md font-bold tracking-tight text-gray-900">Forms</h3>
    <div class="mb-4">
      <div class="mb-2">
        <InputText
          id="dummy-input"
          label="Input Text"
          :name="'dummy_input'"
          v-model:value="input"
        />
        <div>Text input value: {{ input }}</div>
      </div>
      <div class="mb-2">
        <InputCheckbox
      id="dummy-checkbox"
      label="Checkbox"
      :checked="checkbox"
      @input="($event) => updateCheckbox($event.target.checked)"
    />
    <div>Checkbox value: {{ checkbox }}</div>
      </div>
    </div>

    <h3 class="inline-block mb-2 text-md font-bold tracking-tight text-gray-900">Modals</h3>
    <div class="mb-4">
      This SPA has two different modals. Both of them are used for our Leads management. 
      <ul class="space-y-1 list-disc list-inside">
        <li>Lead form Modal: This modal is used to add new leads in our DB or update an existing Lead's data. You can see this modal by clicking on the bottom right floating button (add new lead form), or by editing a Lead from the "All Leads" page.</li>
        <li>Lead Delete Modal: This modal informs the admin that a Lead will be deleted from our DB and confirms the deletion action.</li>
      </ul>
    </div>
  </div>
</template>
