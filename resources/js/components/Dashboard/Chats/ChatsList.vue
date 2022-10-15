<template>
    <div class="max-h-[100vh] flex flex-col bg-light-second">
        <div v-if="user" class=" min-h-[50px] flex items-center ml-2">
             <UserAvatar :avatar="user.data.attributes.avatar"/>
             <div>
                 {{ user.data.attributes.name}}
             </div>

             <!-- <div class="ml-2">
                 <BellIcon size="1.2x"/>
             </div> -->

             <!-- User Menu -->
             <div>
                <ChevronDownIcon @click="toggleUserMenu"
                    class="ml-2 cursor-pointer hover:stroke-theme-second" size="1.3x"/>

                <div v-if="showUserMenu"
                    class="bg-light border-1 rounded-lg shadow-lg absolute z-20 w-[200px] cursor-pointer px-3">

                    <div @click="$refs.avatarInput.click()"
                        class="my-3 hover:text-theme-second">
                        Upload Avatar
                    </div>

                    <input @change="uploadAvatar" ref="avatarInput" v-show="false" type="file" accept="image/*"/>

                    <div @click="logOut"
                        class="my-3 hover:text-theme-second">
                        LogOut
                    </div>
                </div>
            </div>
            <div v-if="showUserMenu" @click="toggleUserMenu" class="fixed top-0 left-0 right-0 bottom-0 z-9 cursor-pointer"></div>

        </div>

        <div class="bg-light-second my-2">
            <div class="flex flex-row w-full p-2">
                <SearchBar/>
                <!-- <div class="flex justify-center items-center mx-3">
                    <UsersIcon @click="groupChat" title="test" class=" cursor-pointer hover:stroke-theme-second"/>
                </div> -->
            </div>
        </div>

        <!-- Chat List -->
        <div v-if="chats" class="h-full overflow-auto">
            <div class="p-2" >
                <div v-for="chat of chats"
                    :key="chat.data.id"
                    @click="getChat(chat.data.id)">

                    <Chat :chat="chat"/>
                </div>
            </div>
        </div>

        <!-- Empty Chat -->
        <div v-if="!chats" class="w-full h-full p-2 flex justify-center items-center">
            <div class="w-[120px] h-[50px] bg-light flex justify-center items-center border-0 rounded-lg text-light-second font-bold">
                Empty chats
            </div>
        </div>

    </div>
</template>

<script>
import UserAvatar from '../../User/UserAvatar'
import Chat from '../../Dashboard/Chats/Chat'
import SearchBar from './SearchBar'
import Spinner from '../../Spinner'
import { mapGetters } from 'vuex'
import { events } from '../../../bus'
import { UsersIcon, BellIcon, ChevronDownIcon } from 'vue-feather-icons'

export default {
    name: 'ChatsList',
    components: {
        ChevronDownIcon,
        UserAvatar,
        SearchBar,
        UsersIcon,
        BellIcon,
        Spinner,
        Chat,
    },
    data () {
        return {
            showUserMenu: false
        }
    },
    computed: {
        ...mapGetters([ 'chats' , 'user', 'oneListDashboard']),
    },
    methods: {
        logOut () {
            this.$store.dispatch('logOut')
        },
        toggleUserMenu() {
            this.showUserMenu = this.showUserMenu ? false : true
        },
        getChat (id) {
            this.$store.dispatch('getChat', id)

            events.$emit('message-input:clear')
            console.log('test')
            if(this.oneListDashboard) {
                this.$store.commit('TOGGLE_SHOW_MESSAGELIST', true)
            }
        },
        uploadAvatar(event) {
            this.$store.dispatch('uploadAvatar', event)

            this.showUserMenu = false
        },
        groupChat () {
            events.$emit('popup:open', {
                name: 'new-group-chat',
            })
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
