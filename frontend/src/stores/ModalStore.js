import { defineStore } from 'pinia'

export const useModalStore = defineStore('ModalStore', {
  state: () => {
    return {
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
      modalIsLoading: false
    }
  },

  getters: {
    getModalIsShowing: (state) => state.modalIsShowing,
    getModalProps: (state) => state.modalProps,
    getModalIsLoading: (state) => state.modalIsLoading
  },

  actions: {
    async submitModal() {
      const res = await this.modalProps.submitAction.apply(null, [this.modalProps.data])
      console.log(res)
      this.setModalIsShowing(false)
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
    initAddMemberModal(action) {
      this.$reset()
      this.setModalPropsSubmitAction(action)
    },
    initEditMemberModal(data, action) {
      this.$reset()
      this.setModalPropsData(data)
      this.setModalPropsSubmitAction(action)
    }
  }
})
