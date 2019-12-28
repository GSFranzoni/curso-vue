import './plugins/bootstrap';
import './plugins/toasted';
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false

require('axios').defaults.headers.common['Authorization'] 
  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFkbWluQGVtYWlsLmNvbSIsImFkbWluIjoiMSIsIm5hbWUiOiJhZG1pbiIsImV4cCI6MTU3ODQ5NjE4NiwiaWF0IjoxNTc3NDk2MTg2fQ.v9RcSLzJDgzciLsuz_fSQ6FIV4EZx8KYZLyYELEsJKE';

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
