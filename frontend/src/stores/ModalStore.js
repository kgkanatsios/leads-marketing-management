import { defineStore } from 'pinia'

export const useModalStore = defineStore('ModalStore', {
  state: () => {
    return {
      modalComponent: 'LeadForm',
      modalIsShowing: false,
      modalProps: {
        data: {
          lead_id: '',
          first_name: '',
          last_name: '',
          email: '',
          consent: false
        },
        submitAction: () => {}
      },
      modalMessages: [],
      modalIsLoading: false
    }
  },

  getters: {
    getModalIsShowing: (state) => state.modalIsShowing,
    getModalProps: (state) => state.modalProps,
    getModalIsLoading: (state) => state.modalIsLoading,
    getModalComponent: (state) => state.modalComponent,
    getModalMessages: (state) => state.modalMessages
  },

  actions: {
    async submitModal() {
      this.setModalIsLoading(true)
      const res = await this.modalProps.submitAction.apply(null, [this.modalProps.data])
      this.setModalMessages(res.messages)
      this.setModalIsLoading(false)
      if (res.result == 'error') {
        return
      }
      this.setModalIsShowing(false)
    },
    setModalComponent(modalComponent) {
      this.modalComponent = modalComponent
    },
    setModalIsShowing(modalIsShowing) {
      this.modalIsShowing = modalIsShowing
    },
    setModalPropsData(data) {
      this.modalProps.data = data
    },
    setModalPropsSubmitAction(action) {
      this.modalProps.submitAction = action
    },
    setModalIsLoading(modalIsLoading) {
      this.modalIsLoading = modalIsLoading
    },
    setModalMessages(modalMessages) {
      this.modalMessages = modalMessages
    },
    initAddMemberModal(action) {
      this.$reset()
      this.setModalComponent('LeadForm')
      this.setModalPropsSubmitAction(action)
    },
    initEditMemberModal(data, action) {
      this.$reset()
      this.setModalComponent('LeadForm')
      this.setModalPropsData(data)
      this.setModalPropsSubmitAction(action)
    },
    initDeletMemberModal(data, action) {
      this.$reset()
      this.setModalComponent('LeadDelete')
      this.setModalPropsData(data)
      this.setModalPropsSubmitAction(action)
    }
  }
})
