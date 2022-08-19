<template>
    <div class="mr-4">
        <!-- Members Avatars -->
        <div v-if="members" class="flex flex-row relative w-[70px]">
            <div v-for="(member) of showedMembers" :key="member.id" class="members">
                <div class="w-10 h-10 bg-theme border-2 rounded-full"
                    :class="`border-${theme}`">
                    <img v-if="member.data.attributes.avatar" class="h-full w-full rounded-full" :src="member.data.attributes.avatar" alt="image">
                    <CustomUserAvatar v-else size="30" class=""/>
                </div>
            </div>

            <!-- Members Count -->
            <div v-if="members.length > 2"
                @click="toggleShowPreview"
                class="flex justify-center items-center mx-2 text-light-second font-bold cursor-pointer"
                :class="`hover:text-${theme}`">
                <PlusIcon size="1x"/>
                <span class="ml-[-3px]">
                    {{ members.length - 2}}
                </span>
            </div>

            <div v-if="showPreview" class="absolute w-[300px] h-auto flex flex-row flex-wrap z-30 border-0 rounded-lg shadow-xl bg-light-second top-[50px] left-[70px]">
                <div class="h-auto w-auto m-2 cursor-pointer flex justify-center items-center" v-for="member of members" :key="member.id">
                    <div class="w-10 h-10 flex items-center" :title="member.data.attributes.name">
                        <img class="w-full h-full rounded-full" v-if="member.data.attributes.avatar" :src="member.data.attributes.avatar"/>
                        <CustomUserAvatar v-else size="30" class=""/>
                    </div>
                </div>
            </div>

             <!-- Close Dropdwon after click outside box -->
            <div v-if="showPreview" @click="toggleShowPreview" class="fixed top-0 left-0 right-0 bottom-0 z-9 cursor-pointer"></div>
        </div>

        <!-- Avatar for single user -->
        <div v-if="!members && avatar" class="w-10 h-10 bg-theme rounded-full"
            :class="`border-${theme}`">
            <img  class="h-full w-full border-0 rounded-full" :src="avatar" alt="image">
        </div>

        <!-- Custom Avatar for users without Avatar -->
        <div v-if="!members && !avatar" class="w-10 h-10 bg-light-second flex rounded-full"
            :class="`border-${theme}`">
            <CustomUserAvatar size="30"/>
        </div>

    </div>
</template>

<script>
import { mapGetters } from 'vuex'
import CustomUserAvatar from '../Icons/CustomUserAvatar'
import { PlusIcon  } from 'vue-feather-icons'

export default {
    name: "UserAvatar",
    props: ["members", "avatar", "theme"],
    components: {
        CustomUserAvatar,
        PlusIcon
    },
    data () {
        return {
            showPreview: false
        }
    },
    computed: {
        ...mapGetters([ 'user' ]),
        showedMembers() {
            let array =  this.members.filter(item => item.data.id !== this.user.data.id)

            return array.slice(0, 2)
        }
    },
    methods: {
        toggleShowPreview () {
            this.showPreview = this.showPreview ? false : true;
        }
    }
}
</script>

<style lang="scss" scoped>

.members {
    &:first-child {
        margin-right: -20px;
    }
}
.wrapper:nth-child(1) {
    // margin-left:0px !important;
}

.wrapper:last-child {
    // margin-right: 10px;
}


</style>
