<template>
    <div class="h-full w-full">
        <div v-if="loaded" class="h-full bg-light text-light-text">
            <div class="dashboard h-full absolute ">
                <!-- <LogoutButton/> -->
                <ChatsList/>
                <MessagesList/>
                <FriendsList/>
            </div>

            <!-- <NotificationList/> -->
            <LightNotification/>
            <FriendListToggle/>

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
import FriendListToggle from '../../components/Dashboard/FriendListToggle'

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
    FriendListToggle
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

    @media (max-width: 768px) {
        .dashboard {
            grid-template-columns: 1fr 2fr;
        }
    }

    @media (max-width: 640px) {
        .dashboard {
            grid-template-columns: 1fr;
            width: 100%;
        }
    }
</style>
