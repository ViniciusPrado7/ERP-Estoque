import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

import router from './router/rotas.js' 

import Toast, { POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const app = createApp(App)

app.use(Toast, {
  position: POSITION.TOP_RIGHT,
  timeout: 3000,
  closeOnClick: true,
  pauseOnHover: true,
  draggable: true,
  showCloseButtonOnHover: false,
})

app.use(router)
app.mount('#app')
