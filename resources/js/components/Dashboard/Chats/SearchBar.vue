<template>
    <div class="w-full flex justify-center items-center">

        <div class="w-full flex">

            <div class="w-full bg-white border-2 border-light-second rounded-lg relative focus-within:border-theme">

                <!-- Input -->
                <div class="p-2">
                    <input v-model="query"
                        @input="searchUser"
                        placeholder="Search Users"
                        class="w-full">
                </div>

                <!-- Dropdown -->
                <div @click.stop v-if="dropDown" class="bg-white shadow-xl max-h-[300px] w-[300px] overflow-auto absolute  h-atuo border-0 rounded-lg z-20 top-[50px]">
                    <div class="w-full h-full">
                        <div v-for="user of searchedUsers" :key="user.data.id" class="cursor-pointer">
                            <div class="flex justify-between items-center p-2">
                                <div class="w-full h-12 flex items-center">
                                    <UserAvatar :avatar="user.data.attributes.avatar" theme="theme"/>
                                    <h1 class="hover:text-theme hover:font-bold"> {{ user.data.attributes.name}} </h1>
                                </div>
                                <UserXIcon v-if="! returnUser && showAddFriendIcon(user)"
                                    @click="cancelFriendship(user)"
                                    class="cursor-pointer stroke-2 mr-2 hover:stroke-theme-second"
                                    size="1.3x" />
                                <UserPlusIcon v-if="! returnUser && !showAddFriendIcon(user)"
                                    @click="addFriend(user)"
                                    class="cursor-pointer stroke-2 mr-2 hover:stroke-theme-second"
                                    size="1.3x" />
                                <MessageSquareIcon v-if="! returnUser"
                                    @click="chat(user)"
                                    class="cursor-pointer stroke-2 hover:stroke-theme-second"
                                    size="1.3x"  />

                                <PlusIcon v-if="returnUser && !showPlusIcon(user)"
                                    class="cursor-pointer stroke-2 hover:stroke-theme-second"
                                    @click="returnedUser(user)"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Close Dropdwon after click outside box -->
            <div v-if="dropDown" @click="closeDropdown" class="fixed top-0 left-0 right-0 bottom-0 z-9 cursor-pointer"></div>

        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Spinner from '../../Spinner'
import { MessageSquareIcon, PlusIcon, UserPlusIcon, UserXIcon  } from 'vue-feather-icons'
import { events } from '../../../bus'
import UserAvatar from '../../User/UserAvatar'

export default {
    name: 'SearchBar',
    components: {
        Spinner,
        PlusIcon,
        UserXIcon,
        UserAvatar,
        UserPlusIcon,
        MessageSquareIcon,
    },
    props: ['returnUser', 'filterUsers'],
    computed: {
        ...mapGetters([ 'chats', 'searchedUsers', 'friendships' ]),
    },
    data () {
        return {
            loaded:false,
            dropDown: false,
            query: '',
        }
    },
    methods: {
        showPlusIcon(user) {
            return this.filterUsers.find(element => element.data.id === user.data.id)
        },
        showAddFriendIcon(user) {
            let array = this.friendships.pending.concat(this.friendships.accepted)

            return array.find(element => element.data.attributes.friend.data.id === user.data.id)

        },
        closeDropdown() {
            this.dropDown = false

            this.query = ''
        },
        searchUser () {
            this.$store.dispatch('searchUsers', this.query).then(() => {
                this.dropDown = true
            })
        },
        chat(user) {

            this.closeDropdown()

            let createNewChat = true

            if(this.chats) {
                this.chats.forEach(chat => {
                    if(chat.data.relationships.members.filter(member => member.data.id === user.data.id).length > 0 &&
                        chat.data.relationships.members.length == 2) {
                        this.$store.commit('SET_CURRENT_CHAT', chat)

                        createNewChat = false

                        return
                    }
                });
            }

            if(createNewChat) {
                events.$emit('popup:open', {
                    name: 'new-chat',
                    payload : {
                        user: user
                    }
                })

                this.dropDown = false
            }
        },
        returnedUser(user) {
            this.$emit('returnedUser', user)
        },
        addFriend(user) {
            this.$store.dispatch('addFriend', user)

            this.closeDropdown()
        },
        cancelFriendship(user) {
            let friendship = this.$findFriendship(user.data.id)

            this.$store.dispatch('updateFriendshipStatus',{
                friendshipId: friendship.data.id,
                status: 'reject'
            })

            this.closeDropdown()
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
