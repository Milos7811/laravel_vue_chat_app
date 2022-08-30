
const defaultState = {
}

const actions = {
    broadcastConnect : ({commit, dispatch, getters}) => {
        Echo.private(`App.Models.User.${getters.user.data.id}`)
        .listen('.message', (response) => {

            commit('PUSH_COMMING_MESSAGE', response)

            commit('PUSH_CHAT_TO_TOP', response.data.attributes.chat_id)

            dispatch('messageSound')

        })
        .listen('.new-chat', (response) => {
            commit('PUSH_NEW_CHAT', response)

            dispatch('messageSound')

        })
        .notification((notification) => {
            console.log(notification)
        })

        Echo.join('User.Presence')
            .here((users) => {
                commit('SET_FRIENDS_STATUS', users)
            })
            .joining((user) => {
                commit('SET_FRIEND_STATUS', {user: user, status: 'online'})
            })
            .leaving((user) => {
                commit('SET_FRIEND_STATUS', {user: user, status: 'offline'})
            })
    },

    messageSound : () => {
        new Audio('/audio/message_voice.mp3').play()
    }
}

const mutations = {

}

const getters = {

}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
