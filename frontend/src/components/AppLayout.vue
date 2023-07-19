<script setup>
import AppHeader from '../components/AppHeader.vue'
import LayoutContainer from './LayoutContainer.vue'
</script>

<template>
  <AppHeader />
  <LayoutContainer>
    <slot></slot>
  </LayoutContainer>
</template>
