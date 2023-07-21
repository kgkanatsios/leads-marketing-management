<script setup>
import { RouterLink } from 'vue-router'
import LayoutContainer from './LayoutContainer.vue'
</script>

<template>
  <header class="border-b-2 border-cyan-400 shadow-lg mb-6 py-3">
    <LayoutContainer>
      <div class="flex items-center">
        <div class="logo flex items-center justify-center">
          <div
            class="mr-2 relative inline-flex items-center justify-center w-14 h-14 overflow-hidden bg-gray-100 rounded-full"
          >
            <span class="font-medium text-gray-600">{{ $t('message.logo.letters') }}</span>
          </div>
          <div class="m-auto">
            <span class="text-xl block">{{ $t('message.logo.title') }}</span>
            <span class="text-xs block">{{ $t('message.logo.subtitle') }}</span>
          </div>
        </div>

        <div class="main-menu ml-auto">
          <ul class="flex m-auto flex-wrap items-center justify-center text-gray-900">
            <RouterLink class="mr-4 hover:text-cyan-700 md:mr-6" to="/">{{
              $t('message.menu.home')
            }}</RouterLink>
            <RouterLink class="hover:text-cyan-700" :to="{ name: 'leadsList' }">{{
              $t('message.menu.leads')
            }}</RouterLink>
          </ul>
        </div>
      </div>
    </LayoutContainer>
  </header>
</template>

<style lang="scss" scoped>
.router-link-active {
  font-weight: bold;
  color: rgb(14 116 144);
}
</style>
