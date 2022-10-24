import axios from 'axios'

const defaultState = {
    chats: undefined,
    currentChat: undefined,
}

const actions = {

    // getAllChats: ({commit}) => {
    //     return new Promise ((resolve, reject) => {
    //         axios.
    //             get('/api/chat')
    //             .then((response) => {

    //                 // if(response.data.data.length > 0) {
    //                 //     commit('SET_CHAT', response.data)

    //                 //     commit('SET_CURRENT_CHAT', response.data.data[0])

    //                 //     // Remove unreaded messages from current opened chat
    //                 //     commit('REMOVE_UNREADED_MESSAGES')

    //                 //     resolve(response.data)
    //                 // }

    //                 commit('SET_LOADED_TRUE')
    //             })
    //             .catch((e) => {
    //                 reject(e)
    //             })
    //     })
    // },

    getChat: ({commit, state, dispatch}, id) => {
        // Load current open chat
        state.chats.map((el) => {
            if(el.data.id === id) {
                commit('SET_CURRENT_CHAT', el)
            }
        })

        dispatch('updateLastReaded', id)
    },

    createNewChat : ({commit}, data) => {
        axios.
            post('/api/chat/create-new',{
                usersId : data.usersId,
                message: data.message
            })
            .then((response) => {
                commit('PUSH_NEW_CHAT', response.data)

                commit('SET_CURRENT_CHAT', response.data)
            })
    },

    newMessage : ({commit}, data) => {
        axios.
            post('api/chat/new-message', {chat_id: data.chat_id, message: data.message})
                .then((response) => {
                    commit('PUSH_NEW_MESSAGE', response.data)


                    commit('PUSH_CHAT_TO_TOP', this.currentChat.data.id)
                })
    },

    updateLastReaded : ({commit}, id) => {
        axios.
            post(`/api/chat/${id}/last-readed`)
            .then(() => {
                commit('REMOVE_UNREADED_MESSAGES')
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
    },
    PUSH_COMMING_MESSAGE(state, data) {

       state.chats.map((el) => {
        if(el.data.id === data.data.attributes.chat_id) {

            el.data.relationships.messages.push(data)

            if(state.currentChat.data.id !== el.data.id) {
                el.data.attributes.unreadedMessagesCount++
            }
        }
       })
    },
    PUSH_NEW_CHAT(state, data) {
        state.chats.unshift(data)
    },
    REMOVE_UNREADED_MESSAGES(state) {
        state.currentChat.data.attributes.unreadedMessagesCount = 0
    },
    PUSH_CHAT_TO_TOP(state, id) {
        let index =_.findIndex(state.chats, function(chat) {return chat.data.id === id})

        if(index != 0) {
            state.chats.move(index, 0)
        }
    },
    CLEAR_CHAT_DATA(state) {
        state.chats = undefined
        state.currentChat = undefined
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
