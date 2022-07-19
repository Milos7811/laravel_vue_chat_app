import axios from 'axios'
import Vue from 'vue'

const defaultState = {
    config: undefined,
}

const actions = {

}

const mutations = {
    SET_CONFIG (state, data) {
        state.config = data
    }
}

const getters = {
    config: (state) => state.config
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
