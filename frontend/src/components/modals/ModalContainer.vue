<script setup>
defineProps({
  onCloseClickHandler: {
    type: Function,
    required: true
  }
})
</script>

<template>
  <div class="z-20 fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 w-2/3 md:w-1/2 xl:w-1/3">
    <div class="relative bg-white rounded-md shadow-md">
      <div class="flex items-center justify-between p-4 border-b">
        <slot name="header-title"></slot>
        <button
          @click="onCloseClickHandler"
          type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
        >
          <svg
            class="w-3 h-3"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 14 14"
          >
            <path
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
            />
          </svg>
          <span class="sr-only">{{ $t('message.modal.button.close') }}</span>
        </button>
      </div>
      <div class="p-4 space-y-6">
        <slot></slot>
      </div>
      <div class="flex items-center justify-between p-4 space-x-2 border-t border-gray-200">
        <slot name="footer-content"></slot>
      </div>
    </div>
  </div>
</template>
