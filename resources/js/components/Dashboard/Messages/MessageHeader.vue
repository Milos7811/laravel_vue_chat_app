<template>
    <div class="min-h-[50px] bg-theme flex px-4">
        <div class="flex flex-row justify-start items-center">
            <ChevronsLeftIcon @click="hideMessageList" v-if="oneListDashboard" size="1.3x"/>
            <UserAvatar :members="currentChat.data.relationships.members" theme="theme-second"/>
            <div v-for="member of currentChat.data.relationships.members" :key="member.data.id">
                <div class="mr-1" v-if="member.data.id != user.data.id">
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
import { ChevronsLeftIcon } from 'vue-feather-icons'

export default {
    name: "MessageHeader",
    components: {
        UserAvatar,
        ChevronsLeftIcon
    },
    methods: {
        hideMessageList () {
            this.$store.commit('TOGGLE_SHOW_MESSAGELIST', false)
        }
    },
    computed: {
        ...mapGetters(["currentChat", "user", 'oneListDashboard']),
        avatar() {
            return this.currentChat.data.relationships.members[0].data.attributes.avatar
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
