<template>
    <div class="h-full">
        <div v-if="loaded" class="flex relative h-full bg-light text-light-text">
            <LogoutButton/>
            <ChatsList/>
            <MessagesList v-if="currentChat != undefined"/>
            <FriendsList/>

            <NewChatPopup/>
            <NewGroupChatPopup/>
        </div>

        <!-- <Notification/> -->
        <Spinner v-if="!loaded"/>
    </div>
</template>

<script>
import MessagesList from '../../components/Dashboard/Messages/MessagesList'
import FriendsList from '../../components/Dashboard/Friends/FriendsList'
import NewGroupChatPopup from '../../components/Popup/NewGroupChatPopup'
import Notification from '../../components/Notification/Notification'
import ChatsList from '../../components/Dashboard/Chats/ChatsList'
import LogoutButton from '../../components/Others/LogoutButton'
import NewChatPopup from '../../components/Popup/NewChatPopup'
import Spinner from '../../components/Spinner'
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
    NewGroupChatPopup,
    FriendsList
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
