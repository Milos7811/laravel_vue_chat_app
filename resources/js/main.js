require('./bootstrap')
import Vue from 'vue'
import VueRouter  from 'vue-router'
import App from './App.vue'
import router from './router'
import store from './store/index'
import helpers from './helpers'

Vue.use(VueRouter)
Vue.use(helpers)

let chatApp = new Vue({
    store,
    router,
    data: {
        config
    },
    render: (h) => h(App),
}).$mount('#app')
