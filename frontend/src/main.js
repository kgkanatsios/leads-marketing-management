import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createI18n } from 'vue-i18n'
import axios from 'axios'

import messages from './locale/messages'

import App from './App.vue'
import router from './router'

const app = createApp(App)

const i18n = createI18n({
  locale: 'en',
  fallbackLocale: 'en',
  messages
})

app.use(createPinia())
app.use(router)
app.use(i18n)

axios.defaults.baseURL = import.meta.env.VITE_SERVER_API_BASE_URL

app.mount('#app')
