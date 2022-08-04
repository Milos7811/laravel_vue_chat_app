<template>
    <PopupWrapper name="new-message">
        <PopupHeader title="New Chat Message"/>

        <PopupContent>
            <div v-if="user" class="flex flex-col">
                <div class="h-[70px] flex items-center">
                    <div class="w-10 h-10 bg-theme border rounded-full mr-3"></div>
                    <h1> {{ user.data.attributes.name}}</h1>
                </div>

                <MessageInput message-type="new-chat" :user-id="user.data.id"/>
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
            loading: false,
        }
    },
    methods: {
        // createChat () {
        //     events.$emit('new-chat:create', this.user.data.id)
        // },
        closePopup() {
            events.$emit('popup:close')
        }
    },
    mounted () {
        events.$on('popup:open', data => {
            this.user = data.payload.user
        })
    }

}
</script>

<style lang="scss" scoped>

</style>
