<template>
    <transition name="fade" appear>
        <div
            class="flex my-4 cursor-pointer p-2 border-0 rounded-lg relative "
            :class="{'bg-theme-second drop-shadow-lg shadow-lg shadow-theme-second' : currentChat.data.id === chat.data.id, 'font-bold' : dotActive  }">

            <!-- Notification dot -->
            <div v-if="dotActive"
                class="notification-dot w-5 h-5 border-0 rounded-full bg-theme-second animate-pulse absolute flex justify-center items-center">
                <div>{{ this.chat.data.attributes.unreadedMessagesCount }}</div>
            </div>

            <div class="flex flex-row items-center overflow-hidden ">

                <UserAvatar :members="chat.data.relationships.members" theme="theme"/>

                <div class="flex flex-col px-2">
                    <div class="flex flex-row">
                        <div v-for="member of chat.data.relationships.members" :key="member.data.id">
                            <div class="whitespace-nowrap mr-1 font-bold" v-if="member.data.id !== user.id">
                                {{ member.data.attributes.name }},
                            </div>
                        </div>
                    </div>
                    <div v-if="chat.data.relationships.messages.length > 0" class="cursor-pointer text-light-second">
                        {{ chat.data.relationships.messages[chat.data.relationships.messages.length -1].data.attributes.message}}
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
        dotActive() {
            return this.chat.data.attributes.unreadedMessagesCount > 0 &&
                this.currentChat.data.id !== this.chat.data.id;
        },
    },
    components: { UserAvatar }
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
