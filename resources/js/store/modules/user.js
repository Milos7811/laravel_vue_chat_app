import axios from 'axios'
import router from '../../router'

const defaultState = {
    user: undefined,
    authCheck: false,
    searchedUsers: [],
    friendships: undefined
}

const actions = {

    getUser: ({commit, dispatch}) => {
        axios.
            get('api/user')
            .then((response) => {
                commit('SET_USER', response.data)

                dispatch('broadcastConnect')

                if(response.data.data.relationships.chats.length > 0) {
                    commit('SET_CHAT',response.data.data.relationships.chats)

                    commit('SET_CURRENT_CHAT', response.data.data.relationships.chats[0])

                    // Remove unreaded messages from current opened chat
                    commit('REMOVE_UNREADED_MESSAGES')
                }

                if(response.data.data.relationships.friendships.length > 0) {
                    commit('SET_FRIENDSHIPS', response.data.data.relationships.friendships )
                }

                commit('SET_LOADED_TRUE')
            })
    },

    searchUsers: ({commit}, query) => {
        return new Promise ((resolve, reject) => {
            axios.
                get(`/api/user/${query}`)
                .then((response) => {
                    commit('SET_SEARCHED_USERS', response.data)

                    resolve(true)
                })
        })
    },

    uploadAvatar: ({}, event) => {

        let data = new FormData()

        let avatar = event.target.files[0]

        // Add image to form
        data.append('avatar', avatar)

        axios.
            post('api/user/avatar', data, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(() => {
                console.log('odoslabne')
            })
    },

    updateUserStatus: ({}, status) => {
        axios.
            post('api/user/status', {
                status: status
            })
    },

    logOut: ({commit, dispatch}) => {
        axios.
            post('/logout')
            .finally(() => {

                commit('SET_LOADED_FALSE')

                commit('SET_AUTH', false)

                commit('CLEAR_USER_DATA')

                commit('CLEAR_CHAT_DATA')

                dispatch('updateUserStatus', 'offline')

                router.push({ name: 'SignIn' })
            })
    }

}

const mutations = {
    SET_USER (state, data) {
        state.user = data
    },
    SET_AUTH (state, data) {
        state.authCheck = data
    },
    SET_SEARCHED_USERS(state, data) {
        state.searchedUsers = []

        state.searchedUsers = data.data
    },
    FILTER_SEARCHED_USERS (state, users) {
        state.searchUsers = state.searchUsers.filter(item => !users.includes(item))
    },
    SET_FRIENDSHIPS (state, data) {
        state.friendships = data
    },
    CLEAR_USER_DATA (state) {
        state.user = undefined
        state.friendships = undefined
    },
}

const getters = {
    user: (state) => state.user,
    authCheck: (state) => state.authCheck,
    searchedUsers: (state) => state.searchedUsers,
    friendships: (state) => state.friendships
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
