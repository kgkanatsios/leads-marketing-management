import { defineStore } from 'pinia'
import axios from 'axios'

export const useLeadStore = defineStore('LeadStore', {
  state: () => {
    return {
      leads: [],
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
        return {
          result: 'success',
          messages: [
            {
              component: 'success',
              message: 'message.lead.response.success.leadAdded',
              translation: true
            }
          ]
        }
      } catch (err) {
        const messages = []
        Object.values(err.response.data.errors.meta).forEach((val) => {
          messages.push({
            component: 'danger',
            message: val.toString(),
            translation: false
          })
        })
        return {
          result: 'error',
          messages: messages
        }
      }
    },

    async updateLead(lead) {
      try {
        const response = await axios.put('/leads/' + lead.lead_id, lead)
        const leadIndex = this.leads.findIndex(
          (lead) => lead.data.lead_id == response.data.data.lead_id
        )
        this.leads[leadIndex] = response.data
        return {
          result: 'success',
          messages: [
            {
              component: 'success',
              message: 'message.lead.response.success.leadUpdated',
              translation: true
            }
          ]
        }
      } catch (err) {
        const messages = []
        Object.values(err.response.data.errors.meta).forEach((val) => {
          messages.push({
            component: 'danger',
            message: val.toString(),
            translation: false
          })
        })
        return {
          result: 'error',
          messages: messages
        }
      }
    },

    async deleteLead(lead) {
      try {
        const lead_id = lead.lead_id
        await axios.delete('/leads/' + lead_id)
        const leadIndex = this.leads.findIndex((lead) => lead.data.lead_id == lead_id)
        this.leads.splice(leadIndex, 1)
        return {
          result: 'success',
          messages: [
            {
              component: 'success',
              message: 'message.lead.response.success.leadAdded',
              translation: true
            }
          ]
        }
      } catch (err) {
        const messages = []
        Object.values(err.response.data.errors.meta).forEach((val) => {
          messages.push({
            component: 'danger',
            message: val.toString(),
            translation: false
          })
        })
        return {
          result: 'error',
          messages: messages
        }
      }
    }
  }
})
