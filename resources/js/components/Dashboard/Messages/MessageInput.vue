<template>
    <div class=" h-[60px] flex justify-center flex items-center">
        <div class="px-4 bg-theme border-0 rounded-lg w-3/4 h-3/4">
            <input v-model="message"
                @keypress.enter="send"
                class=" w-full h-full input bg-theme text-light-text"/>
        </div>
        <!-- <button @click="newMessage">Butt</button> -->
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { events } from '../../../bus'

export default {
    name: 'MessageInput',
    props: ['messageType'],
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
            if(this.messageType !== 'new-chat')
                this.newMessage
        },
        newMessage () {
            axios.
                post('api/chat/new-message', {chat_id: this.currentChat.data.id, message: this.message})
                    .then((response) => {
                        this.$store.commit('PUSH_NEW_MESSAGE', response.data)

                        this.message = ''

                        this.$store.commit('PUSH_CHAT_TO_TOP', this.currentChat.data.id)
                    })
        },
        newChat (userId) {
            this.$store.dispatch('createNewChat', {message: this.message, usersId: [userId]})

            events.$emit('popup:close')
        }
    },
    mounted () {
        events.$on('message-input:clear', () => {
            this.message = ''
        })

        if(this.messageType === 'new-chat') {
            events.$on('new-chat:create', (userId) => {
                this.newChat(userId)
            })
        }
    },
    beforeDestroy () {
        events.$off('new-chat:create')
    }

}
</script>

<style lang="scss" scoped>

</style>
