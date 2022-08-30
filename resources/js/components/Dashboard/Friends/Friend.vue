<template>
    <div>
        <div class="flex flex-col cursor-default bg-light hover:bg-theme p-2 border-0 rounded-lg">
            <div class="flex justify-between mb-1">
                <div class="flex flex-row items-center">
                    <UserAvatar :avatar="friendship.data.attributes.friend.data.attributes.avatar"/>
                    <div class="font-bold">
                        {{friendship.data.attributes.friend.data.attributes.name}}
                    </div>
                </div>
                <div class="justify-self-end">
                    <UserStatusDot :friendship="friendship"/>
                </div>
            </div>

            <div v-if="showAction" class="flex">
                <div class="w-1/2 flex justify-center">
                    <CheckIcon @click="responseToFriendship('accept')" class="cursor-pointer hover:stroke-theme-second" size="1.2x"/>
                </div>
                <div class="w-1/2 flex justify-center">
                    <XIcon @click="responseToFriendship('reject')" class="cursor-pointer hover:stroke-theme-second" size="1.2x"/>
                </div>
            </div>

            <div v-if="showPendingText" class="flex justify-center">
                <span class="text-[13px]" >
                    Waiting to accept ...
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import UserAvatar from '../../User/UserAvatar';
import UserStatusDot from '../../User/UserStatusDot';
import { XIcon, CheckIcon  } from 'vue-feather-icons'

export default {
    name: 'Friend',
    props: [ 'friendship' ] ,
    components: {
        XIcon,
        CheckIcon,
        UserAvatar,
        UserStatusDot,
    },
    computed: {
        showAction () {
            return this.friendship.data.attributes.status  === 'pending' &&
                !this.friendship.data.attributes.isAuthor
        },
        showPendingText() {
            return this.friendship.data.attributes.status  === 'pending' &&
                this.friendship.data.attributes.isAuthor
        }
    },
    methods: {
        responseToFriendship (action) {
            this.$store.dispatch('responseToFriendship', {
                friendshipId: this.friendship.data.id,
                action: action
            })
        }
    }

}
</script>

<style lang="scss" scoped>

</style>
