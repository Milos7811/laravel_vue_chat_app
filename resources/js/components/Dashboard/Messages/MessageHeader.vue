<template>
    <div class="bg-theme flex px-4">
        <div class="flex flex-row justify-start items-center">
             <div class="w-10 h-10 bg-theme border rounded-full mr-3"></div>
            <div> {{currentChat.data.relationships.members[0].data.attributes.name}} </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'MessageHeader',
    computed: {
        ...mapGetters([ 'currentChat' ])
    },

}
</script>

<style lang="scss" scoped>

</style>
