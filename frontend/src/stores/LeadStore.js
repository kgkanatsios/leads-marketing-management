import { defineStore } from 'pinia'

export const useLeadStore = defineStore('LeadStore', {
  state: () => {
    return {
      leads: [],
      errors: [],
      loading: false
    }
  },

  getters: {},

  actions: {}
})
