<template>
    <div class="w-1/3 h-full bg-light-second">

        <div v-if="user" class=" h-[50px] flex justify-start items-center ml-2">
             <UserAvatar :avatar="user.data.attributes.avatar"/>
             <!-- <input type="file" accept="image/*" @change="uploadAvatar"/> -->
             <div>
                 {{ user.data.attributes.name}}
             </div>
        </div>

        <div class=" bg-light-second mt-4">

            <div class="flex flex-row w-full p-2">
                <SearchBar/>
                <div class="flex justify-center items-center mx-3">
                    <UsersIcon @click="groupChat" title="test" class=" cursor-pointer hover:stroke-theme-second"/>
                </div>
            </div>
        </div>


        <div v-if="chats" class="w-full p-2">

            <div v-for="chat of chats.data"
                :key="chat.data.id"
                @click="getChat(chat.data.id)">

                <Chat :chat="chat"/>
            </div>
        </div>

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
import { UsersIcon } from 'vue-feather-icons'

export default {
    name: 'ChatsList',
    components: {
    Spinner,
    Chat,
    SearchBar,
    UserAvatar,
    UsersIcon
},
    computed: {
        ...mapGetters([ 'chats' , 'user' ]),
    },
    data() {
        return {
            loading: true,
        };
    },
    methods: {
        getChat (id) {
            this.$store.dispatch('getChat', id)

            events.$emit('message-input:clear')
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
    mounted() {
        this.$store.dispatch('getAllChats').then(() => {
            this.loading = false;
        });
    },
}
</script>

<style lang="scss" scoped>

</style>
