<template>
    <div>
        <div v-if="members" class="flex flex-row">
            <div v-for="(member) of members" :key="member.id"
                :class="{'wrapper ml-[-30px]' : members.length > 2 }"
                >
                <div v-if="member.data.id !== user.id" class="w-10 h-10 bg-theme border-2 rounded-full mr-3"
                    :class="`border-${theme}`">
                    <img v-if="member.data.attributes.avatar" class="h-full w-full border-0 rounded-full" :src="member.data.attributes.avatar" alt="image">
                </div>
            </div>
        </div>

        <div v-if="!members" class="w-10 h-10 bg-theme rounded-full mr-3">
            <img  class="h-full w-full border-0 rounded-full" :src="avatar" alt="image">
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'UserAvatar',
    props: [ 'members', 'avatar' , 'theme'],
    computed: {
        ...mapGetters([ 'user' ])
    },
}
</script>

<style lang="scss" scoped>
.wrapper:nth-child(1) {
    margin-left:30px !important;
}

.wrapper:last-child {
    margin-right: 10px;
}


</style>
