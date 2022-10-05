<template>
    <div class="h-full">
        <div v-if="loaded" class="h-full bg-light text-light-text">
            <div class="dashboard h-full w-full absolute grid-cols-{1fr 2fr 1fr}">
                <!-- <LogoutButton/> -->
                <ChatsList/>
                <MessagesList v-show="showMessages"/>
                <FriendsList v-show="showFriends"/>
            </div>

            <!-- <NotificationList/> -->
            <LightNotification/>

            <NewChatPopup/>
            <NewGroupChatPopup/>
        </div>

        <!-- <Notification/> -->
        <Spinner v-if="!loaded"/>
    </div>
</template>

<script>
    import LightNotification from '../../components/Notification/LightNotification'
import NotificationList from '../../components/Notification/NotificationList'
import MessagesList from '../../components/Dashboard/Messages/MessagesList'
import FriendsList from '../../components/Dashboard/Friends/FriendsList'
import NewGroupChatPopup from '../../components/Popup/NewGroupChatPopup'
import ChatsList from '../../components/Dashboard/Chats/ChatsList'
import LogoutButton from '../../components/Others/LogoutButton'
import NewChatPopup from '../../components/Popup/NewChatPopup'
import Spinner from '../../components/Spinner'
import { mapGetters } from 'vuex';

export default {
    name: "Dashboard",
    components: {
    LightNotification,
    NewGroupChatPopup,
    NotificationList,
    MessagesList,
    LogoutButton,
    NewChatPopup,
    FriendsList,
    ChatsList,
    Spinner,
},
    data () {
        return {
            showMessages: true,
            showFriends: true,
        }
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
    .dashboard {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
    }
</style>
