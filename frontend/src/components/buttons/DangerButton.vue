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
    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
  >
    {{ text }}
  </button>
</template>
