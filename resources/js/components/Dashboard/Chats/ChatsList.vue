<template>
    <div class="w-1/3 border-r-2 border-third">

        <Spinner v-if="loading"/>

        <SearchBar/>

        <div class="w-full p-2">

            <div v-for="chat of chats.data"
                :key="chat.id"
                @click="getChat(chat.data.id)"
                class="flex my-4 cursor-pointer p-2 border-0 rounded-lg "
                :class="{'bg-five drop-shadow-2xl shadow-lg shadow-five' : currentChat.data.id === chat.data.id  }">

                <Chat :chat="chat"/>
            </div>
        </div>
    </div>
</template>

<script>
import Spinner from '../../Spinner.vue'
import Chat from '../../Dashboard/Chats/Chat'
import SearchBar from './SearchBar.vue'
import { mapGetters } from 'vuex'

export default {
    name: 'ChatsList',
    components: {
        Spinner,
        Chat,
        SearchBar,
    },
    computed: {
        ...mapGetters(['chats', 'currentChat' ]),
    },
    data() {
        return {
            loading: true,
        };
    },
    methods: {
        getChat (id) {
            this.$store.dispatch('getChat', id)
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
