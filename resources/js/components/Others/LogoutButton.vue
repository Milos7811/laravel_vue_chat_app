<template>
    <div @click="logOut"
        class="absolute bottom-5 left-5 cursor-pointer h-10 w-10  flex justify-center items-center border-0 rounded-full">
        <LogOutIcon class="hover:stroke-theme-second"/>
    </div>
</template>

<script>
import { LogOutIcon } from 'vue-feather-icons'

export default {
    name: 'LogoutButton',
    components: {
        LogOutIcon
    },
    methods: {
        logOut () {
            this.$store.dispatch('logOut')
        }
    }

}
</script>

<style lang="scss" scoped>

</style>
