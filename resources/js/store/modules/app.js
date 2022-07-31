import axios from 'axios'
import Vue from 'vue'

const defaultState = {
    config: undefined,
    loaded: false,
}

const actions = {

}

const mutations = {
    SET_CONFIG (state, data) {
        state.config = data
    },
    SET_LOADED_TRUE(state) {
        state.loaded = true
    },
    SET_LOADED_FALSE (state) {
        state.loaded = false
    }
}

const getters = {
    config: (state) => state.config,
    loaded: (state) => state.loaded
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
