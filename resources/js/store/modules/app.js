import axios from 'axios'
import Vue from 'vue'

const defaultState = {
    config: undefined,
    loaded: false,
    oneListDashboard: false,
    showFriendList: false,
    dinamicFriendList: false,
    showMessageList: true
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
    },
    SET_DINAMIC_FRIENDLIST (state) {
        state.dinamicFriendList = true
    },
    TOGGLE_SHOW_FRIENDLIST (state) {
        state.showFriendList = state.showFriendList ? false : true
    },
    TOGGLE_SHOW_MESSAGELIST (state, toggle) {
        state.showMessageList = toggle
    },
    SET_ONE_LIST_DASHBOARD (state) {
        state.oneListDashboard = true
    }
}

const getters = {
    config: (state) => state.config,
    loaded: (state) => state.loaded,
    oneListDashboard: (state) => state.oneListDashboard,
    showFriendList: (state) => state.showFriendList,
    dinamicFriendList: (state) => state.dinamicFriendList,
    showMessageList: (state) => state.showMessageList
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
