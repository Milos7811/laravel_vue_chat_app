<template>
    <transition name="fade" appear>
        <div
            class="flex my-4 cursor-pointer p-2 border-0 rounded-lg relative "
            :class="{'bg-theme-second drop-shadow-lg shadow-md shadow-theme-second' : currentChat.data.id === chat.data.id, 'font-bold' : newMessageCount  }">

            <!-- Notification dot -->
            <div v-if="newMessageCount"
                class="notification-dot w-5 h-5 border-0 z-10 rounded-full bg-theme-second animate-pulse absolute flex justify-center items-center">
                <div>{{ this.chat.data.attributes.unreadedMessagesCount }}</div>
            </div>

            <div class="flex flex-row items-center overflow-hidden max-w-full">

                <UserAvatar :members="chat.data.relationships.members" theme="theme"/>

                <div class="px-2">
                    <div class="flex flex-row">
                        <div v-for="member of chat.data.relationships.members" :key="member.data.id">
                            <div class="whitespace-nowrap mr-1 font-bold text-ellipsis overflow-hidden" v-if="member.data.id !== user.data.id">
                                {{ userName }}
                            </div>
                        </div>
                    </div>
                    <div v-if="chat.data.relationships.messages.length > 0" class="cursor-pointer text-light-second">
                        {{ message(chat.data.relationships.messages[chat.data.relationships.messages.length -1].data.attributes.message) }}
                    </div>
                </div>
            </div>

        </div>
    </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import UserAvatar from '../../User/UserAvatar'

export default {
    name: "Chat",
    props: ["chat"],
    components: {
        UserAvatar
    },
    computed: {
        ...mapGetters(["currentChat", "user"]),
        newMessageCount() {
            return this.chat.data.attributes.unreadedMessagesCount > 0 &&
                this.currentChat.data.id !== this.chat.data.id;
        },
        userName() {
            let name = undefined
            this.chat.data.relationships.members.forEach((member) => {
                if(member.data.attributes.name !== this.user.data.attributes.name) {
                    name =  member.data.attributes.name
                }
            })
            return name
        },
    },
    methods: {
        message (string) {
            if(window.innerWidth < 1220) {
                return _.truncate(string, {'length': 18,})
            }

            return _.truncate(string, {'length': 25,})
        },
    },
}
</script>

<style lang="scss" scoped>

.fade-enter-active {
  transition: all 0.3s ease-out;
}

.fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter,
.fade-leave {
  transform: translateY(-20px);
  opacity: 0;
}

</style>
