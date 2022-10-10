<template>
    <div v-if="showMessageList" class="max-h-[100vh] max-w-[100vh] bg-light"
        :class="{'absolute z-10 w-full' : oneListDashboard }">

        <div class="w-full h-full" v-if="currentChat === undefined">
            <div class="w-full h-full p-2 flex justify-center items-center">
                <div class="w-[120px] h-[50px] bg-light-second flex justify-center items-center border-0 rounded-lg text-light-second font-bold">
                    Messages
                </div>
            </div>
        </div>

        <div v-if="currentChat" class="w-full h-full flex flex-col">
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
        ...mapGetters(['currentChat', 'showMessageList', 'oneListDashboard']),
        messages() {
            return this.currentChat.data.relationships.messages
        },
    },
}
</script>

<style lang="scss" scoped>


</style>
