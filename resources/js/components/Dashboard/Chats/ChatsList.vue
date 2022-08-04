<template>
    <div class="w-1/3 bg-light-second">

        <div class=" h-[50px] flex justify-start items-center ml-2">
             <div class="w-10 h-10 bg-theme border rounded-full mr-3"></div>
             <div v-if="user">
                 {{ user.name}}
             </div>
        </div>

        <div class=" bg-light-second mt-4">
            <SearchBar/>

            <div v-if=" chats != undefined" class="w-full p-2">

                <div v-for="chat of chats.data"
                    :key="chat.data.id"
                    @click="getChat(chat.data.id)">

                    <Chat :chat="chat"/>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Spinner from '../../Spinner.vue'
import Chat from '../../Dashboard/Chats/Chat'
import SearchBar from './SearchBar.vue'
import { mapGetters } from 'vuex'
import { events } from '../../../bus'

export default {
    name: 'ChatsList',
    components: {
        Spinner,
        Chat,
        SearchBar,
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
