<template>
    <div class="search-bar bg-third">
        <div class="h-full flex justify-center items-center relative">
            <div  class="w-2/3 p-2 bg-white border-0 rounded-lg">
                <input v-model="query"
                   @input="searchUser"
                    class="w-full">
            </div>
            <div v-if="dropDown" class="dropdown-searchbar bg-white absolute w-2/3 h-atuo border-0 rounded-lg z-10">

                <!-- <Spinner class="spinner"/> -->

                <div class="w-full h-full">
                    <div v-for="user of searchedUsers" :key="user.data.id">
                        <div class="w-full h-12 bg-second mb-2 flex items-center">
                            <div class="w-10 h-10 bg-third border rounded-full mr-1"></div>
                            <h1> {{ user.data.attributes.name}} </h1>
                            <MessageSquareIcon @click="chat(user.data.id)"
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
import { MessageSquareIcon  } from 'vue-feather-icons'

export default {
    name: 'SearchBar',
    components: {
        Spinner,
        MessageSquareIcon
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
                this.loaded = true
                console.log(this.searchedUsers)
            })
        },
        chat(id) {

            let createNewChat = true

            this.chats.data.forEach(chat => {
                if(chat.data.relationships.members.filter(member => member.data.id === id).length > 0) {
                    this.$store.commit('SET_CURRENT_CHAT', chat)

                    createNewChat = false

                    return
                }
            });

            if(createNewChat)
                this.$store.dispatch('createNewChat', id)

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
