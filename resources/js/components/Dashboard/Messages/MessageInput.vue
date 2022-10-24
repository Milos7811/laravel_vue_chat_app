<template>
    <div class=" min-h-[65px] flex justify-center items-center py-2 ">
        <div class="pl-4 pr-2 bg-light border-[1px] rounded-lg border-theme w-3/4 h-[35px] flex flex-row items-center">
            <input v-model="message"
                @input="query"
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
        query() {
            this.$emit('query', this.message)
        },
        send () {
            this.$emit('send')
        },
    },
    mounted () {
        events.$on('message-input:clear', () => {
            this.message = ''
        })
    },
    beforeDestroy () {
        events.$off('new-chat:create')
    }

}
</script>

<style lang="scss" scoped>

</style>
