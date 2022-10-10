<template>
    <div class="h-screen bg-gradient-to-r bg-light font-lato font-nunito text-light-text">
        <router-view/>
    </div>
</template>

<script>
import HomePage from './views/FrontPage/HomePage'
import { mapGetters } from 'vuex'

export default {
    name: 'App',
    components: { HomePage },
    computed: {
        ...mapGetters([ 'loaded', 'config'])
    },
    beforeMount () {
        this.$store.commit('SET_CONFIG', this.$root.$data.config)

        this.$store.commit('SET_AUTH', this.$root.$data.config.authCheck)

        if(config.authCheck && this.$route.name !== null) {
            this.$router.push({name: 'Dashboard'})
        }

        if(window.screen.width <= 768) {
            this.$store.commit('SET_DINAMIC_FRIENDLIST')
        }

        if(window.screen.width <= 640) {
            this.$store.commit('SET_ONE_LIST_DASHBOARD')
            this.$store.commit('TOGGLE_SHOW_MESSAGELIST', false)
        }
    },
}
</script>


<style lang="scss" scoped>

</style>
