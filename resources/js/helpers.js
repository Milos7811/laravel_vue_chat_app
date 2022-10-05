import store from './store/index'

const helpers = {
    install(Vue) {
        Array.prototype.move = function (from, to) {
            this.splice(to, 0, this.splice(from, 1)[0]);
          };

        Vue.prototype.$findNotification = function (friendshipId) {
            let notifications = store.getters.notifications.unreadNotifications.concat(store.getters.notifications.readNotifications)

            let findNotification = undefined

            notifications.map(notification => {
                if(notification.data.attributes.payload.friendship.data.id === friendshipId) {
                    findNotification = notification
                }
            })

            return findNotification ? findNotification : null
        }

        Vue.prototype.$findFriendship = function (userId) {
            let friendships = store.getters.friendships.accepted.concat(store.getters.friendships.pending)

            let findFriendship = undefined

            friendships.map(friendship => {
                if(friendship.data.attributes.friend.data.id === userId) {
                    findFriendship = friendship
                }
            })

            return findFriendship ? findFriendship : null
        }

        Vue.prototype.$isMobile = function () {
            const toMatch = [/Android/i, /webOS/i, /iPhone/i, /iPad/i, /iPod/i, /BlackBerry/i, /Windows Phone/i]

            return toMatch.some((toMatchItem) => {
                return navigator.userAgent.match(toMatchItem)
            })
        }
    }
}

export default helpers
