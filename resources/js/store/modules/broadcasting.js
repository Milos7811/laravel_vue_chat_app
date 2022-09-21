import { events } from '../../bus'

const defaultState = {
    notifications : []
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
            if(notification.category === 'friend-request') {

                commit('PUST_NOTIFICATION', {
                    data: {
                        type: notification.category,
                        id: notification.id,
                        attributes: {
                            category: notification.category,
                            title: notification.title,
                            description: notification.description,
                            payload: {
                                action: notification.data.action,
                                friendship: notification.data.friendship
                            }
                        },
                    },
                })
                commit('PUSH_FRIENDSHIP', {
                    type : 'pending',
                    data : notification.data.friendship
                })
            }

            if(notification.category === 'friend-accept') {
                commit('REMOVE_FRIENDSHIP', {
                    data: notification.data.friendship,
                    type: 'pending'
                })

                commit('PUSH_FRIENDSHIP', {
                    data: notification.data.friendship,
                    type: 'accepted'
                })

                events.$emit('light-notification:open', {
                    title: 'Friendship was accepted.',
                    description: `${notification.data.friendship.data.attributes.friend.data.attributes.name} was accepted your Friendship request.`
                })

            }

            if(notification.category === 'friend-cancel') {
                commit('REMOVE_FRIENDSHIP', {
                    data: notification.data.friendship,
                    type: notification.data.friendship.data.attributes.status
                })

                events.$emit('light-notification:open', {
                    title: 'Friendship was rejected.',
                    description: `${notification.data.friendship.data.attributes.friend.data.attributes.name} rejected your Friendship request.`
                })
            }
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
    SET_NOTIFICATIONS(state, data) {
        state.notifications = data
    },
    PUST_NOTIFICATION(state, data) {
        state.notifications.unreadNotifications.push(data)
    },
    CHANGE_NOTIFICATION_STATUS(state, data) {
        state.notifications.unreadNotifications.map(notification => {
            if(notification.data.id === data.notification.data.id) {
                notification.data.attributes.payload.friendship.data.attributes.status = data.status
            }
        })

        state.notifications.readNotifications.map(notification => {
            if(notification.data.id === data.notification.data.id) {
                notification.data.attributes.payload.friendship.data.attributes.status = data.status
            }
        })
    }
}

const getters = {
    notifications: (state) => state.notifications,
}

export default {
    state: defaultState,
    getters,
    actions,
    mutations,
}
