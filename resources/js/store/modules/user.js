import axios from 'axios'
import { forEach } from 'lodash'
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

    uploadAvatar: ({}, event) => {

        let data = new FormData()

        let avatar = event.target.files[0]

        // Add image to form
        data.append('avatar', avatar)

        // axios
        //     .post(`${store.getters.api}/user/avatar`, formData, {
        //         headers: {
        //             'Content-Type': 'multipart/form-data',
        //         },


        console.log(avatar)
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
    },
    FILTER_SEARCHED_USERS (state, users) {
        state.searchUsers = state.searchUsers.filter(item => !users.includes(item))
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
