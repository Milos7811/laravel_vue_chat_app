<template>
    <div class="w-2/3 h-screen">

        <MessageHeader class="header"/>

        <div class="messages-wrapper">
            <div class="max-h-full flex flex-col-reverse overflow-auto h-full px-10">
               <div class=" flex flex-col">
                   <div class="mt-auto" v-for="message of currentChat.data.relationships.messages"
                       :key="message.data.id">
                       <Message :message="message.data"/>
                   </div>
               </div>
           </div>
        </div>

        <div class="input-wrapper">
            <MessageInput/>
        </div>

    </div>
</template>

<script>
import MessageInput from './MessageInput';
import MessageHeader from './MessageHeader.vue'
import { mapGetters } from 'vuex';
import { events } from '../../../bus'
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
    },
    data () {
        return {
            chat: '',
        }
    },
}
</script>

<style lang="scss" scoped>

.messages-wrapper {
    height: 88%;
}

.input-wrapper {
    height: 7%;
}

.header {
    height: 5%;
}

</style>
