<template>
    <PopupWrapper name="new-chat">
        <PopupHeader title="New Chat Message"/>

        <PopupContent>
            <div v-if="user" class="flex flex-col">
                <div class="h-[70px] flex items-center">
                    <div class="w-10 h-10 bg-theme border rounded-full mr-3"></div>
                    <h1> {{ user.data.attributes.name}}</h1>
                </div>

                <MessageInput @keypress.native.enter="createNewChat" @query="setMessage" @send="createNewChat"/>
            </div>
        </PopupContent>

        <PopupAction>
            <ButtonCustom @click.native="closePopup" button-style="cancel">
                Cancel
            </ButtonCustom>

            <!-- <ButtonCustom @click.native="createChat" button-style="accept" :loading="loading">
                Send
            </ButtonCustom> -->
        </PopupAction>
    </PopupWrapper>
</template>

<script>
import PopupWrapper from './Parts/PopupWrapper'
import PopupHeader from './Parts/PopupHeader'
import PopupContent from './Parts/PopupContent'
import MessageInput from '../Dashboard/Messages/MessageInput'
import PopupAction from './Parts/PopupAction'
import ButtonCustom from '../Others/ButtonCustom'
import { events } from '../../bus'

export default {
    name: 'NewChatPopup',
    components: {
    PopupWrapper,
    PopupHeader,
    PopupContent,
    MessageInput,
    PopupAction,
    ButtonCustom
},
    data () {
        return {
            user: undefined,
            message: '',
            loading: false,
        }
    },
    methods: {
        setMessage(message) {
            this.message = message
        },
        closePopup() {
            events.$emit('popup:close')
        },
        createNewChat () {
            this.$store.dispatch('createNewChat', {
                usersId : [this.user.data.id],
                message: this.message
            })

            this.closePopup()
        },
    },
    mounted () {
        events.$on('popup:open', data => {
            if(data.name === 'new-chat')
                this.user = data.payload.user
        })

        events.$on('popup:close', () => { this.user = undefined, this.message = '' })
    }

}
</script>

<style lang="scss" scoped>

</style>
