<template>
    <div class="w-[300px] bg-light-second">
        <div class="min-h-[50px]  flex items-center pl-2">
            Friend List
        </div>

        <div>
            <div @click="toggleShow('acceptedShow')"
                class=" h-[30px] cursor-pointer flex justify-center items-center">
                Accepted
                <ArrowDownIcon class="ml-2" size="1x"
                    :class="{'rotate-180' : acceptedShow}"/>
            </div>
            <div v-if="acceptedShow" class="">
                <div class="p-2" v-for="friendship in friendships.accepted" :key="friendship.data.id">
                    <Friend :friendship="friendship"/>
                </div>
            </div>
        </div>

        <!-- <div>
            <div @click="toggleShow('rejectedShow')"
                class=" h-[30px] cursor-pointer flex justify-center items-center">
                Rejected
                <ArrowDownIcon class="ml-2" size="1x"
                    :class="{'rotate-180' : rejectedShow}"/>
            </div>
            <div v-if="rejectedShow" class="">
                <div class="p-2" v-for="friendship in friendships.rejected" :key="friendship.data.id">
                    <Friend :friendship="friendship"/>
                </div>
            </div>
        </div> -->

        <div>
            <div @click="toggleShow('pendingShow')"
                class=" h-[30px] cursor-pointer flex justify-center items-center">
                Pending
                <ArrowDownIcon class="ml-2" size="1x"
                    :class="{'rotate-180' : pendingShow}"/>
            </div>
            <div v-if="pendingShow" class="">
                <div class="p-2" v-for="friendship in friendships.pending" :key="friendship.data.id">
                    <Friend :friendship="friendship"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import Friend from './Friend'
import { ArrowDownIcon } from 'vue-feather-icons'

export default {
    name: 'FriendsList',
    computed: {
        ...mapGetters([ 'friendships' ])
    },
    components: {
        Friend,
        ArrowDownIcon
    },
    data () {
        return {
            acceptedShow: undefined,
            rejectedShow: undefined,
            pendingShow: undefined
        }
    },
    methods: {
        toggleShow (type) {
            this[type] = this[type] ? false : true;

            localStorage.setItem(type, this[type])
        }
    },
    created () {
        this.acceptedShow = JSON.parse(localStorage.getItem('acceptedShow'))
        // this.rejectedShow = JSON.parse(localStorage.getItem('rejectedShow'))
        this.pendingShow = JSON.parse(localStorage.getItem('pendingShow'))
    }
}
</script>

<style lang="scss" scoped>

</style>
