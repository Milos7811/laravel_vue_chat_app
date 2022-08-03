<template>
    <div>
        <h1>heloo</h1>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'Notification',
    computed: {
        ...mapGetters([ 'user' ])
    },
    mounted () {

    }

}
</script>

<style lang="scss" scoped>

</style>
