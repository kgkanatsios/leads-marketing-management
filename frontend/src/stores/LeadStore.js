import { defineStore } from 'pinia'
import axios from 'axios'

export const useLeadStore = defineStore('LeadStore', {
  state: () => {
    return {
      leads: [],
      errors: [],
      isLoading: false
    }
  },

  getters: {
    getLeads: (state) => state.leads,
    getErrors: (state) => state.errors,
    getIsLoading: (state) => state.isLoading
  },

  actions: {
    async fetchLeads() {
      this.setIsLoading(true)
      await axios
        .get('/leads')
        .then((res) => {
          this.leads = res.data.data
          this.setIsLoading(false)
        })
        .catch((error) => {
          this.leads = []
          this.setIsLoading(false)
          console.log(error)
        })
    },

    setIsLoading(isLoading) {
      this.isLoading = isLoading
    }

    // addLead(lead) {},

    // updateLead(lead) {},

    // deleteLead(lead) {}
  }
})
