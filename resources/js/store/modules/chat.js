import axios from 'axios'
import Vue from 'vue'

const defaultState = {
    chats: [],
    currentChat: undefined,
}

const actions = {

    getAllChats: ({commit}) => {
        return new Promise ((resolve, reject) => {
            axios.
                get('/api/chat')
                .then((response) => {

                    commit('SET_CHAT', response.data)

                    commit('SET_CURRENT_CHAT', response.data.data[0])

                    resolve(response.data)
                })
                .catch((e) => {
                    reject(e)
                })
        })
    },

    getChat: ({commit}, id) => {
        return new Promise ((resolve, reject) => {
            axios.
                get(`api/chat/${id}`)
                .then((response) => {
                    commit('CLEAR_MESSAGES')

                    commit('SET_CURRENT_CHAT', response.data)

                    resolve(response.data)
                })
                .catch((e) => {
                    reject(e)
                })
        })
    }

}

const mutations = {
    SET_CHAT(state, data) {
        state.chats = data
    },
    SET_CURRENT_CHAT(state, data) {
        state.currentChat = data
    },
    CLEAR_MESSAGES(state) {
        state.currentChat = undefined
    },
    PUSH_NEW_MESSAGE(state, data) {
        state.currentChat.data.relationships.messages.push(data)
    }
}

const getters = {
    chats: (state) => state.chats,
    currentChat: (state) => state.currentChat
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
