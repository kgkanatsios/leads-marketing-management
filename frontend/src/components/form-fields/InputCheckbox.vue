<script>
export default {
  inheritAttrs: false
}
</script>
<script setup>
defineProps({
  id: {
    type: String,
    required: true
  },
  label: {
    type: String
  },
  checked: {
    type: Boolean,
    default: true
  }
})

defineEmits(['update:checked'])
</script>
<template>
  <div class="inline-flex items-center justify-center font-semibold text-gray-900">
    <input
      v-bind="$attrs"
      :id="id"
      :checked="checked"
      type="checkbox"
      class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 focus:ring-2"
    />
    <label :for="id" class="ml-2 text-sm font-medium text-gray-900">{{
      $t('message.lead.marketingConsent')
    }}</label>
  </div>
</template>
