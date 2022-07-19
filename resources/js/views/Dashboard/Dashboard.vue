<template>
    <div class="flex relative">
        <LogoutButton/>
        <ChatsList/>
        <MessagesList v-if="currentChat != undefined"/>
    </div>
</template>

<script>
import MessagesList from '../../components/Dashboard/Messages/MessagesList'
import ChatsList from '../../components/Dashboard/Chats/ChatsList'
import LogoutButton from '../../components/Others/LogoutButton'
import { mapGetters } from 'vuex';

export default {
    name: "Dashboard",
    components: {
        ChatsList,
        MessagesList,
        LogoutButton
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
