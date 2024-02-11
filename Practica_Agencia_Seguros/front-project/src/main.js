import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import PrimeVue from 'primevue/config';
import Wind from '@/presets/wind';


import App from './App.vue'
import router from './router'

const app = createApp(App)
app.use(PrimeVue, {
    unstyled: true,
    pt: Wind
});

app.use(createPinia())
app.use(router)

app.mount('#app')
