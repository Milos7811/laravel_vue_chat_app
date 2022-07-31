<template>
    <div class=" h-full m-auto flex justify-center flex items-center">
        <div class="px-4 bg-third border-0 rounded-lg w-3/4 h-3/4">
            <input v-model="message"
                @keypress.enter="newMessage"
                class=" w-full h-full input bg-third text-text"/>
        </div>
        <!-- <button @click="newMessage">Butt</button> -->
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { events } from '../../../bus'

export default {
    name: 'MessageInput',
    computed: {
        ...mapGetters([ 'currentChat' ])
    },
    data () {
        return {
            message: ''
        }
    },
    methods: {
        newMessage () {
            axios.
                post('api/chat/new-message', {chat_id: this.currentChat.data.id, message: this.message})
                    .then((response) => {
                        this.$store.commit('PUSH_NEW_MESSAGE', response.data)

                        this.message = ''

                        this.$store.commit('PUSH_CHAT_TO_TOP', this.currentChat.data.id)
                    })
        }
    },
    mounted () {
        events.$on('message-input:clear', () => {
            this.message = ''
        })
    }

}
</script>

<style lang="scss" scoped>

</style>
