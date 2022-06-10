<template>
    <div class="h-screen bg-gradient-to-r bg-main font-lato font-nunito text-text">
        <!-- <Spinner/> -->

        <router-view/>
    </div>
</template>

<script>
import HomePage from './views/FrontPage/HomePage'
import Spinner from './components/Spinner.vue'

export default {
    name: 'App',
    components: { HomePage, Spinner },

}
</script>


<style lang="scss" scoped>

</style>
