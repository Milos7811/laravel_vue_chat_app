<template>
    <div class="flex relative">
        <LogoutButton/>
        <ChatsList/>
        <MessagesList v-if="currentChat != undefined"/>

        <!-- <Notification/> -->
    </div>
</template>

<script>
import MessagesList from '../../components/Dashboard/Messages/MessagesList'
import ChatsList from '../../components/Dashboard/Chats/ChatsList'
import LogoutButton from '../../components/Others/LogoutButton'
import Notification from '../../components/Notification/Notification';
import { mapGetters } from 'vuex';

export default {
    name: "Dashboard",
    components: {
    ChatsList,
    MessagesList,
    LogoutButton,
    Notification
},
    computed: {
        ...mapGetters(['config', 'currentChat'])
    },
    created () {
        this.$store.dispatch('getUser')
    }
}
</script>

<style lang="scss" scoped>

</style>
