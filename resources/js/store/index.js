import Vuex from 'vuex'
import Vue from 'vue'

import userAuth from './modules/userAuth'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        // userAuth,
    }
})
