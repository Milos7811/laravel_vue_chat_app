<template>
    <div class="search-bar bg-theme">
        <div class="h-full flex justify-center items-center relative">

            <div  class="w-2/3 p-2 bg-white border-0 rounded-lg">
                <input v-model="query"
                   @input="searchUser"
                    class="w-full">
            </div>

             <UsersIcon title="test" class="ml-4 cursor-pointer hover:stroke-theme-second"/>

            <div v-if="dropDown" class="dropdown-searchbar bg-white absolute w-2/3 h-atuo border-0 rounded-lg z-10">
                <!-- <Spinner class="spinner"/> -->

                <div class="w-full h-full">
                    <div v-for="user of searchedUsers" :key="user.data.id">
                        <div class="w-full h-12 mb-2 flex items-center">
                            <div class="w-10 h-10 bg-theme border rounded-full mr-1"></div>
                            <h1> {{ user.data.attributes.name}} </h1>
                            <MessageSquareIcon @click="chat(user)"
                                class="message-icon cursor-pointer"
                                size="1.3x"  />
                        </div>
                    </div>
                </div>
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
            dropDown: true,
            query: '',
        }
    },
    methods: {
        searchUser () {
            this.$store.dispatch('searchUsers', this.query).then(() => {
                this.dropDown = true
            })
        },
        chat(user) {

            let createNewChat = true

            this.chats.data.forEach(chat => {
                if(chat.data.relationships.members.filter(member => member.data.id === user.data.id).length > 0) {
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

.search-bar {
    height: 5%;
    .dropdown-searchbar  {
        top: 50px;
    }
}
.message-icon {
    stroke-width: 1;
}
</style>
