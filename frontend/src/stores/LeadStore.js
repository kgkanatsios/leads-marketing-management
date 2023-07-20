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
    },

    async addLead(lead) {
      try {
        const response = await axios.post('/leads', lead)
        this.leads.push(response.data)
        return response.data
      } catch (err) {
        return err.response.data
      }
    },

    updateLead(lead) {
      console.log(lead)
    },

    deleteLead(lead) {
      console.log(lead)
    }
  }
})
