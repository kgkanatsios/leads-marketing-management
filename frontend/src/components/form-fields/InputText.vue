<script setup>
defineProps({
  id: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  value: {
    type: String,
    required: true
  },
  label: {
    type: String,
    required: true
  },
  type: {
    type: String,
    default: 'text'
  },
  placeholder: {
    type: String,
    default: ''
  },
  required: {
    type: Boolean,
    default: false
  }
})

defineEmits(['update:value'])
</script>

<template>
  <div>
    <label :for="id" class="block mb-2 text-sm font-medium text-gray-900">
      {{ label }}
    </label>
    <input
      :value="value"
      @input="$emit('update:value', $event.target.value)"
      :type="type"
      :id="id"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      :placeholder="placeholder"
      :required="required"
    />
  </div>
</template>
