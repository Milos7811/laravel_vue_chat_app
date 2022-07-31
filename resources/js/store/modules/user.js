import axios from 'axios'
import router from '../../router'

const defaultState = {
    user: undefined,
    authCheck: false,
    searchedUsers: [],
}

const actions = {

    getUser: ({commit, dispatch}, id) => {
        axios.
            get('api/user')
            .then((response) => {
                commit('SET_USER', response.data)

                dispatch('broadcastConnect')
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

    logOut: () => {
        axios.
            post('/logout')
            .then(() => {
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
    }
}

const getters = {
    user: (state) => state.user,
    authCheck: (state) => state.authCheck,
    searchedUsers: (state) => state.searchedUsers,
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
