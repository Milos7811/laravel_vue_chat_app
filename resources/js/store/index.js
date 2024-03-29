import Vuex from 'vuex'
import Vue from 'vue'

import app from './modules/app'
import chat from './modules/chat'
import user from './modules/user'
import friendship from './modules/friendship'
import broadcasting from './modules/broadcasting'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        broadcasting,
        friendship,
        chat,
        user,
        app,
    }
})
