<template>
    <div class="w-[300px] bg-light-second">
        <div class="min-h-[50px]  flex justify-center items-center">
            Friend List
        </div>
        <div class="p-2" v-for="friendship in friendships" :key="friendship.data.id">
            <div class="flex flex-row justify-between cursor-pointer bg-light hover:bg-theme p-2 border-0 rounded-lg">
                <div class="flex flex-row items-center">
                    <UserAvatar :avatar="friendship.data.attributes.friend.data.attributes.avatar"/>
                    <div class="font-bold">
                        {{friendship.data.attributes.friend.data.attributes.name}}
                    </div>
                </div>
                <UserStatusDot :status="friendship.data.attributes.friend.data.attributes.status" class="justify-self-end"/>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import UserAvatar from '../../User/UserAvatar';
import UserStatusDot from '../../User/UserStatusDot';
export default {
    name: "FriendsList",
    computed: {
        ...mapGetters(["friendships"])
    },
    components: {
        UserAvatar,
        UserStatusDot
    }
}
</script>

<style lang="scss" scoped>

</style>
