<template>
    <PopupWrapper name="new-group-chat">

        <PopupHeader title="New Group Chat"/>

        <PopupContent>
            <SearchBar :return-user="true" :filter-users="users" @returnedUser="addUser($event)"/>

            <div class="min-h-[70px] h-[160px] overflow-auto border-2 my-3 rounded-lg">
                <div v-if="users.length > 0" class="flex flex-wrap">
                    <div v-for="user of users" :key="user.data.id" class="flex h-[50px] justify-center items-center m-2 p-2 bg-light-second border-0 rounded-lg">
                        <UserAvatar :avatar="user.data.attributes.avatar"/>
                        <div>{{user.data.attributes.name}}</div>
                        <XIcon @click="removeUser(user)" class="ml-2 cursor-pointer hover:stroke-theme-second" size="1x"/>
                    </div>
                </div>

                <div v-if="users.length === 0" class="h-full m-auto flex justify-center items-center text-second-text font-bold">
                    <p>Selected Users</p>
                </div>
            </div>

            <div class="my-2">
                <MessageInput message-type="new-chat" :users-id="getUsersIds" />
            </div>
        </PopupContent>

        <PopupAction>

            <ButtonCustom @click.native="closePopup" button-style="cancel">
                Cancel
            </ButtonCustom>

        </PopupAction>

    </PopupWrapper>
</template>

<script>
import PopupWrapper from './Parts/PopupWrapper'
import PopupHeader from './Parts/PopupHeader'
import PopupContent from './Parts/PopupContent'
import SearchBar from '../Dashboard/Chats/SearchBar'
import UserAvatar from '../User/UserAvatar'
import MessageInput from '../Dashboard/Messages/MessageInput'
import { XIcon } from 'vue-feather-icons'
import { events } from '../../bus'
import PopupAction from './Parts/PopupAction'
import ButtonCustom from '../Others/ButtonCustom'

export default {
    name: 'NewGroupChatPopup',
    components: {
    PopupWrapper,
    PopupHeader,
    PopupContent,
    SearchBar,
    UserAvatar,
    XIcon,
    MessageInput,
    PopupAction,
    ButtonCustom
},
    data () {
        return {
            users: []
        }
    },
    computed: {
        getUsersIds () {
            let array = []

            this.users.forEach(user => {
                array.push(user.data.id)
            })

            return array
        }
    },
    methods: {
        addUser (user) {
            this.users.push(user)
        },
        removeUser(user) {
            this.users = this.users.filter(item => item.data.id !== user.data.id)
        },
        closePopup() {
            events.$emit('popup:close')
        }
    },
    mounted () {
        events.$on('popup:close', () => { this.users = [] })
    }
}
</script>

<style lang="scss" scoped>

</style>
