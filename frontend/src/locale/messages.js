const messages = {
  en: {
    message: {
      logo: {
        letters: 'LW',
        title: 'LW Assignment',
        subtitle: 'by Konstantinos Gkanatsios'
      },
      menu: {
        home: 'Home',
        about: 'About',
        leads: 'All Leads'
      },
      lead: {
        numOfLeads: '{leadsNum} Leads exist in our database!',
        marketingConsent: 'Marketing Consent',
        button: {
          edit: 'Edit',
          subscribe: 'Subscribe',
          cancel: 'Cancel',
          delete: 'Delete'
        },
        modal: {
          title: 'Stay up to date!',
          subtitle: 'Subscribe to our newsletters',
          titleDelete: 'Hey! {leadEmail} will be deleted!',
          textDelete: 'Are you sure you want to remove the lead with mail account "{leadEmail}"?'
        },
        form: {
          field: {
            firstName: 'First name',
            lastName: 'Last name',
            email: 'Your email',
            marketingConsent: 'Marketing Consent'
          }
        },
        response: {
          success: {
            leadAdded: 'Added',
            leadUpdate: 'Updated',
            leadDeleted: 'Deleted'
          }
        }
      },
      modal: {
        button: {
          close: 'Close'
        }
      },
      loading: 'Loading...'
    }
  }
}

export default messages
