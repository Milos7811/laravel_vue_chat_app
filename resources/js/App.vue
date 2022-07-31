<template>
    <div class="h-screen bg-gradient-to-r bg-main font-lato font-nunito text-text">
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
    }

}
</script>


<style lang="scss" scoped>

</style>
