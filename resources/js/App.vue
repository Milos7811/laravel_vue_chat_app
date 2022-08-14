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

       console.log(this.$route.name)

        if(config.authCheck && this.$route.name !== null) {
            this.$router.push({name: 'Dashboard'})
        }
    }

}
</script>


<style lang="scss" scoped>

</style>
