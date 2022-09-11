import axios from 'axios'
import Vue from 'vue'

const defaultState = {
    friendships: undefined
}

const actions = {
    addFriend: ({commit}, user) => {
        axios.
            post('/api/user/friendship-create', {
                friendId: user.data.id
            })
            .then((response) => {
                commit('PUSH_FRIENDSHIP', {
                    data: response.data,
                    type: 'pending'
                })
            })
    },

    updateFriendshipStatus: ({commit}, data) => {

        axios.
            post('/api/user/friendship-status', {
                friendshipId: data.friendshipId,
                status: data.status
            })

            .then((response) => {
                commit('REMOVE_FRIENDSHIP', {
                    data: response.data,
                    type: 'pending'
                })

                if(data.status === 'accept') {
                    commit('PUSH_FRIENDSHIP', {
                        data: response.data,
                        type: 'accepted'
                    })
                }

                if(data.status === 'reject' && response.data.data.attributes.status == 'accepted') {
                    commit('REMOVE_FRIENDSHIP', {
                        data: response.data,
                        type: 'accepted'
                    })
                }

                if(Vue.prototype.$findNotification(data.friendshipId)) {
                    commit('CHANGE_NOTIFICATION_STATUS', {
                        notification : Vue.prototype.$findNotification(data.friendshipId),
                        status: data.status
                    })
                }


            })
    },
}

const mutations = {
    SET_FRIENDSHIPS (state, data) {
        state.friendships = data
    },
    SET_FRIEND_STATUS(state, data) {
        let index = _.findIndex(state.friendships.accepted, function(friendship) {
            return friendship.data.attributes.friend.data.id === data.user.data.id
        })
        if(index !== -1) {
            state.friendships.accepted[index].data.attributes.friend.data.attributes.status = data.status
        }
    },
    SET_FRIENDS_STATUS(state, users) {
        state.friendships.accepted.filter((friendship) => {
            _.findKey(users, function(user) {
                if(user.data.id === friendship.data.attributes.friend.data.id) {
                    friendship.data.attributes.friend.data.attributes.status = 'online'
                }
            })
        })
    },
    PUSH_FRIENDSHIP(state, data) {
        if(data.type === 'pending') {
            state.friendships.pending.push(data.data)
        }

        if(data.type === 'accepted') {
            state.friendships.accepted.push(data.data)
        }
    },
    REMOVE_FRIENDSHIP(state, data) {
        if(data.type === 'pending' || 'rejected') {
            state.friendships.pending =  state.friendships.pending.filter(
                friendship => data.data.data.id !== friendship.data.id
            )
        }

        if(data.type === 'accepted' || 'rejected') {
            state.friendships.accepted =  state.friendships.accepted.filter(
                friendship => data.data.data.id !== friendship.data.id
            )
        }
    }
}

const getters = {
    friendships: (state) => state.friendships
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
