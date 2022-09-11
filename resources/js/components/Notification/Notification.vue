<template>
    <div>
        <div>
            <div class="font-bold text-base">
                {{ notification.data.attributes.title}}
            </div>
            <div>
                {{notification.data.attributes.description}}
                {{ notification.data.attributes.payload.friendship.data.attributes.friend.data.attributes.name}}
            </div>
        </div>

        <div v-if="notification.data.attributes.payload.friendship.data.attributes.status === 'pending'"
            class="grid grid-cols-2 mt-2">
            <div class="flex justify-center p-2">
                <CheckIcon @click="acceptFriendship"
                    size="1.2x"
                    class="cursor-pointer hover:stroke-theme-second"/>
            </div>
            <div class="flex justify-center p-2">
                <XIcon @click="cancelFriendship"
                    size="1.2x"
                    class="cursor-pointer hover:stroke-theme-second"/>
            </div>
       </div>
    </div>
</template>

<script>
import { XIcon, CheckIcon  } from 'vue-feather-icons'

export default {
    name: 'Notification',
    props: [ 'notification' ],
    components: {
        XIcon,
        CheckIcon,
    },
    methods: {
        acceptFriendship () {
            this.$store.dispatch('updateFriendshipStatus',{
                friendshipId: this.notification.data.attributes.payload.friendship.data.id,
                status: 'accept'
            })
        },
        cancelFriendship() {
            // this.$store.dispatch('cancelFriendship', this.notification.data.attributes.payload.friendship.data.attributes.friend)
            this.$store.dispatch('updateFriendshipStatus',{
                friendshipId: this.notification.data.attributes.payload.friendship.data.id,
                status: 'reject'
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
