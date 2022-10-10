<template>
    <div v-if="! showFriendList && dinamicFriendList"
        @click="hideFriendList"
        class="absolute z-30 right-4 top-[49vh] p-1 cursor-pointer ">
        <ChevronsLeftIcon  class="stroke-2 hover:stroke-theme-second" size="1.3x"/>
    </div>
</template>

<script>
import { ChevronsLeftIcon } from 'vue-feather-icons'
import { mapGetters } from 'vuex'

export default {
    name:'FriendListToggle',
    components: {
        ChevronsLeftIcon,
    },
    computed: {
        ...mapGetters([ 'showFriendList', 'dinamicFriendList' ]),
        showButton() {
            return window.screen.width < 768
        }
    },
    methods: {
        hideFriendList () {
            this.$store.commit('TOGGLE_SHOW_FRIENDLIST')
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
