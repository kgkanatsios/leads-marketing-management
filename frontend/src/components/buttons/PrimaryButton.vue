<script setup>
defineProps({
  text: {
    type: String,
    required: true
  }
})
</script>
<template>
  <button
    type="button"
    class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
  >
    {{ text }}
  </button>
</template>
