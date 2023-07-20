<script setup>
defineProps({
  onCloseClickHandler: {
    type: Function,
    required: true
  }
})
</script>

<template>
  <div
    @click="onCloseClickHandler"
    class="bg-opacity-70 bg-slate-600 fixed w-full h-full left-0 top-0 flex items-center justify-center z-10"
  >
    <slot></slot>
  </div>
</template>
