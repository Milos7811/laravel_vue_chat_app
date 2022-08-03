<template>
    <div>
        <div v-show="loaded" class="flex relative bg-light text-light-text">
            <LogoutButton/>
            <ChatsList/>
            <MessagesList v-if="currentChat != undefined"/>

            <NewMessagePopup/>
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
import NewMessagePopup from '../../components/Popup/NewMessagePopup';
import { mapGetters } from 'vuex';

export default {
    name: "Dashboard",
    components: {
    ChatsList,
    MessagesList,
    LogoutButton,
    Notification,
    NewMessagePopup,
    Spinner
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
