<template>
    <div class="h-full">
        <div v-show="loaded" class="flex relative h-full bg-light text-light-text">
            <LogoutButton/>
            <ChatsList/>
            <MessagesList v-if="currentChat != undefined"/>

            <NewChatPopup/>
            <NewGroupChatPopup/>
        </div>

        <!-- <Notification/> -->
        <Spinner v-if="!loaded"/>
    </div>
</template>

<script>
import MessagesList from '../../components/Dashboard/Messages/MessagesList'
import ChatsList from '../../components/Dashboard/Chats/ChatsList'
import LogoutButton from '../../components/Others/LogoutButton'
import Notification from '../../components/Notification/Notification';
import Spinner from '../../components/Spinner'
import NewChatPopup from '../../components/Popup/NewChatPopup';
import NewGroupChatPopup from '../../components/Popup/NewGroupChatPopup';
import { mapGetters } from 'vuex';

export default {
    name: "Dashboard",
    components: {
    ChatsList,
    MessagesList,
    LogoutButton,
    Notification,
    NewChatPopup,
    Spinner,
    NewGroupChatPopup
},
    computed: {
        ...mapGetters(['loaded','config', 'currentChat'])
    },
    created () {
        this.$store.dispatch('getUser')
    }
}
</script>

<style lang="scss" scoped>

</style>
