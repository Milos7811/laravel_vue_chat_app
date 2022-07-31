<template>
    <div>
        <div v-show="loaded" class="flex relative">
            <LogoutButton/>
            <ChatsList/>
            <MessagesList v-if="currentChat != undefined"/>
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
import Spinner from '../../components/Spinner.vue'
import { mapGetters } from 'vuex';

export default {
    name: "Dashboard",
    components: {
    ChatsList,
    MessagesList,
    LogoutButton,
    Notification,
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
