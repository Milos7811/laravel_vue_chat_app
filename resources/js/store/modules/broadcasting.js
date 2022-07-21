
const defaultState = {
    config: undefined,
}

const actions = {
    broadcastConnect : ({commit, getters}) => {
        Echo.private(`App.Models.User.${getters.user.id}`)
        .listen('.message', (response) => {

            commit('PUSH_COMMING_MESSAGE', response)
            console.log(response)
            // console.log(response.data.attributes.chat_id)
            // console.log(getters.chats.data.id)
            // console.log(getters.chats)

            // console.log(_.find(getters.chats.data, function(item) {return item.data.id === response.data.attributes.chat_id }))

            // commit('PUSH_NEW_MESSAGE', response)
        })
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
