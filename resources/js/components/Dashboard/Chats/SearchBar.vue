<template>
    <div class="h-[50px] flex justify-center items-center ml-4 bg-light-second">

        <div class="w-full flex">
            <div class="w-full bg-white border-2 border-transparent rounded-lg relative focus-within:border-theme ">
                <div class="p-2">
                    <input v-model="query"
                        @input="searchUser"
                        placeholder="Search Users"
                        class="w-full">
                </div>

                <!-- Dropdown -->
                <div @click.stop v-if="dropDown" class="bg-white shadow-xl absolute w-full h-atuo border-0 rounded-lg z-20 top-[50px]">
                    <div class="w-full h-full">
                        <div v-for="user of searchedUsers" :key="user.data.id" class="cursor-pointer">
                            <div class="flex justify-between items-center p-2">
                                <div class="w-full h-12 flex items-center">
                                    <div class="w-10 h-10 bg-theme border rounded-full mr-2"></div>
                                    <h1 class="hover:text-theme hover:font-bold"> {{ user.data.attributes.name}} </h1>
                                </div>
                                <MessageSquareIcon @click="chat(user)"
                                    class="cursor-pointer stroke-2 hover:stroke-theme-second"
                                    size="1.3x"  />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Close Dropdwon after click outside box -->
            <div v-if="dropDown" @click="closeDropdown" class="fixed top-0 left-0 right-0 bottom-0 z-9 cursor-pointer"></div>

            <div class="flex justify-center items-center mx-3">
                <UsersIcon title="test" class=" cursor-pointer hover:stroke-theme-second"/>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Spinner from '../../Spinner'
import { MessageSquareIcon, UsersIcon } from 'vue-feather-icons'
import { events } from '../../../bus'

export default {
    name: 'SearchBar',
    components: {
        Spinner,
        MessageSquareIcon,
        UsersIcon,
    },
    computed: {
        ...mapGetters([ 'chats', 'searchedUsers' ])
    },
    data () {
        return {
            loaded:false,
            dropDown: false,
            query: '',
        }
    },
    methods: {
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

            this.chats.data.forEach(chat => {
                if(chat.data.relationships.members.filter(member => member.data.id === user.data.id).length > 0 &&
                    chat.data.relationships.members.length == 2) {
                    this.$store.commit('SET_CURRENT_CHAT', chat)

                    createNewChat = false

                    return
                }
            });

            if(createNewChat) {
                events.$emit('popup:open', {
                    name: 'new-message',
                    payload : {
                        user: user
                    }
                })

                this.dropDown = false
            }
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
