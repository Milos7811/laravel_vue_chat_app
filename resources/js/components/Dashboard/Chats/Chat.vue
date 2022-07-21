<template>
    <div
        class="flex my-4 cursor-pointer p-2 border-0 rounded-lg relative"
        :class="{'bg-five drop-shadow-2xl shadow-lg shadow-five' : currentChat.data.id === chat.data.id  }">

        <!-- Notification dot -->
        <div v-if="dotActive"
            class="notification-dot w-5 h-5 border-0 rounded-full bg-third animate-pulse absolute flex justify-center items-center">
            <div>{{ this.chat.data.attributes.unreadedMessagesCount }}</div>
        </div>

        <div class="flex flex-row items-center">


            <div class="w-10 h-10 bg-third border rounded-full mr-3"></div>

            <div class="flex flex-col">

                <div class="flex">
                    <div v-for="member of chat.data.relationships.members" :key="member.data.id">
                        {{ `${member.data.attributes.name}` }}
                    </div>
                </div>
                <div class="cursor-pointer">Message</div>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: 'Chat',
    props: ['chat', 'user'],
    computed: {
        ...mapGetters([ 'currentChat']),
        dotActive() {
            return this.chat.data.attributes.unreadedMessagesCount > 0 &&
                this.currentChat.data.id !== this.chat.data.id
        },
        // checkLastRead() {
        //     this.currentChat.data.relationships.members.map((user) => {
        //         if(user.data.id === this.user.id) {
        //             user.data.attributes.lastReaded >
        //         }
        //     })
        // }
    },

}
</script>

<style lang="scss" scoped>

.notification-dot {
    top: -6px;
    right: -3px;
}

</style>
