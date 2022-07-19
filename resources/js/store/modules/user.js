import axios from 'axios'
import router from '../../router'

const defaultState = {
    user: undefined,
    authCheck: false,
}

const actions = {

    getUser: ({commit}, id) => {
        axios.
            get('api/user')
            .then((response) => {
                commit('SET_USER', response.data)
            })
    },

    searchUsers: ({commit, state}, query) => {
        axios.
            get(`/api/user/${query}`)
            .then((response) => {
                console.log(response.data)
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
    }
}

const getters = {
    user: (state) => state.user,
    authCheck: (state) => state.authCheck,
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
