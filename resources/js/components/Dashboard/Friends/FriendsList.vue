<template>
    <div v-if="showFriendList || !dinamicFriendList" class="max-h-[100vh] bg-light-second"
        :class="{'absolute h-[100vh] w-[250px] right-0 z-30' : interactiveList }">
        <div class="flex justify-between">
            <div class="min-h-[50px]  flex items-center pl-2">
                Friend List
            </div>

            <div v-if="dinamicFriendList"
                @click="visibleFriendList"
                class="flex items-center mr-2 px-2 cursor-pointer">
                <ChevronsRightIcon size="1.3x"/>
            </div>
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
import { ArrowDownIcon , ChevronsRightIcon  } from 'vue-feather-icons'

export default {
    name: 'FriendsList',
    components: {
        Friend,
        ArrowDownIcon,
        ChevronsRightIcon,
    },
    data () {
        return {
            acceptedShow: undefined,
            rejectedShow: undefined,
            pendingShow: undefined
        }
    },
    computed: {
        ...mapGetters([ 'friendships' , 'showFriendList', 'dinamicFriendList']),
        interactiveList () {
            return window.screen.width < 768
        }
    },
    methods: {
        toggleShow (type) {
            this[type] = this[type] ? false : true;

            localStorage.setItem(type, this[type])
        },
        visibleFriendList () {
            this.$store.commit('TOGGLE_SHOW_FRIENDLIST')
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
