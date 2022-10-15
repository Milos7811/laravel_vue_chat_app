<template>
    <div class=" min-h-[65px] flex justify-center flex items-center py-2 ">
        <div class="pl-4 pr-2 bg-light border-[1px] rounded-lg border-theme w-3/4 h-[35px] flex flex-row items-center">
            <input v-model="message"
                @keypress.enter="send"
                placeholder="Type your message here..."
                class=" w-full h-full input bg-light text-light-text "/>
            <SendIcon @click="send" class="ml-2 cursor-pointer hover:stroke-theme"/>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { events } from '../../../bus'
import { SendIcon } from 'vue-feather-icons'

export default {
    name: 'MessageInput',
    props: ['messageType', 'usersId'],
    components: { SendIcon },
    computed: {
        ...mapGetters([ 'currentChat' ])
    },
    data () {
        return {
            message: '',
        }
    },
    methods: {
        send () {
            if(this.messageType !== 'new-chat') {
                this.newMessage()
            } else {
                this.newChat()
            }
        },
        newMessage () {
            if(this.message) {
                axios.
                    post('api/chat/new-message', {chat_id: this.currentChat.data.id, message: this.message})
                        .then((response) => {
                            this.$store.commit('PUSH_NEW_MESSAGE', response.data)

                            this.message = ''

                            this.$store.commit('PUSH_CHAT_TO_TOP', this.currentChat.data.id)
                        })
            }
        },
        newChat () {
            this.$store.dispatch('createNewChat', {message: this.message, usersId: this.usersId})

            events.$emit('popup:close')
        }
    },
    mounted () {
        events.$on('message-input:clear', () => {
            this.message = ''
        })

        // if(this.messageType === 'new-chat') {
        //     events.$on('new-chat:create', (userId) => {
        //         this.newChat(userId)
        //     })
        // }
    },
    beforeDestroy () {
        events.$off('new-chat:create')
    }

}
</script>

<style lang="scss" scoped>

</style>
