<template>
    <div class="m-4 flex flex-row items-center"
        :class="{'justify-end' : isUserMessage }">
        <div v-if="!isUserMessage" class="w-10 h-10 bg-third border rounded-full mr-2">

        </div>

        <div class="border-0 rounded-lg p-3 shadow-xl"
            :class="{'bg-five' : isUserMessage }">
            <!-- <h1 v-if="!isUserMessage"> {{ message.relationships.owner.attributes.name}} </h1> -->
            <h2> {{ message.attributes.message }}</h2>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: 'Message',
    props: ['message'],
    computed: {
        ...mapGetters([ 'user' ]),
        isUserMessage() {
            return this.message.relationships.owner.data.id === this.user.id
        }
    },

}
</script>

<style lang="scss" scoped>

</style>
