<template>
    <div class="w-2/3 h-screen flex flex-col">

        <MessageHeader/>

        <div class="flex-auto overflow-auto">
            <div class="max-h-full flex flex-col-reverse overflow-auto h-full px-10">
               <div class=" flex flex-col">
                   <div class="mt-auto" v-for="message of messages"
                       :key="message.data.id">
                       <Message :message="message.data"/>
                   </div>
               </div>
           </div>
        </div>

        <MessageInput/>

    </div>
</template>

<script>
import MessageInput from './MessageInput';
import MessageHeader from './MessageHeader'
import { mapGetters } from 'vuex';
import Message from './Message'

export default {
    name: 'MessagesList',
    components: {
        Message,
        MessageInput,
        MessageHeader,
    },
    computed: {
        ...mapGetters(['currentChat', 'user']),
        messages() {
            return this.currentChat.data.relationships.messages
        }
    },
    data () {
        return {
            chat: '',
        }
    },
}
</script>

<style lang="scss" scoped>


</style>
