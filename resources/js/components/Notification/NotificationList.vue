<template>
    <div class="absolute bg-white p-3">
        <Notification :notification="notification"
            v-for="notification of notifications.unreadNotifications" :key="notification.data.id"/>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import  Notification from './Notification'

export default {
    name: 'NotificationList',
    components: { Notification},
    computed: {
        ...mapGetters([ 'notifications' ])
    },

}
</script>

<style lang="scss" scoped>

</style>
