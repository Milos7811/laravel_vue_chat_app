<template>
    <div class="max-h-[100vh] flex flex-col bg-light-second">

        <!-- <input type="file" accept="image/*" @change="uploadAvatar"/> -->
        <div v-if="user" class=" min-h-[50px] flex items-center ml-2">
             <UserAvatar :avatar="user.data.attributes.avatar"/>
             <div>
                 {{ user.data.attributes.name}}
             </div>
             <div class="ml-2">
                 <BellIcon size="1.2x"/>
             </div>

        </div>

        <div class="bg-light-second my-2">
            <div class="flex flex-row w-full p-2">
                <SearchBar/>
                <div class="flex justify-center items-center mx-3">
                    <UsersIcon @click="groupChat" title="test" class=" cursor-pointer hover:stroke-theme-second"/>
                </div>
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
import { UsersIcon, BellIcon  } from 'vue-feather-icons'

export default {
    name: 'ChatsList',
    components: {
        Spinner,
        Chat,
        SearchBar,
        UserAvatar,
        UsersIcon,
        BellIcon
    },
    computed: {
        ...mapGetters([ 'chats' , 'user', 'oneListDashboard']),
    },
    methods: {
        test() {
            events.$emit('light-notification:open', {
                    title: 'Friendship was accepted.',
                    description: `Milos Holba was accepted your friendship request.`
                })
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
