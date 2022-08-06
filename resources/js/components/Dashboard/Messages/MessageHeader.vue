<template>
    <div class="min-h-[50px] bg-theme flex px-4">
        <div class="flex flex-row justify-start items-center">
            <UserAvatar :members="currentChat.data.relationships.members" theme="theme-second"/>
            <div v-for="member of currentChat.data.relationships.members" :key="member.data.id">
                <div class="mr-1" v-if="member.data.id != user.id">
                    {{ member.data.attributes.name }},
                </div>
            </div>
            <!-- <div> {{currentChat.data.relationships.members[0].data.attributes.name}} </div> -->
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import UserAvatar from '../../User/UserAvatar'

export default {
    name: "MessageHeader",
    computed: {
        ...mapGetters(["currentChat", "user"]),
        avatar() {
            return this.currentChat.data.relationships.members[0].data.attributes.avatar
        }
    },
    components: { UserAvatar }
}
</script>

<style lang="scss" scoped>

</style>
