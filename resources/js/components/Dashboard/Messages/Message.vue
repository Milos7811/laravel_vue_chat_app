<template>
    <transition name="fade" appear>
        <div class="m-3 flex flex-row items-center"
            :class="{'justify-end' : isUserMessage }">
            <div v-if="!isUserMessage" class="w-10 h-10 bg-theme border rounded-full mr-2">
            <UserAvatar :avatar="message.relationships.owner.data.attributes.avatar"/>

            </div>

            <div class="border-0 rounded-lg p-3 drop-shadow-lg shadow-xl"
                :class="{'bg-theme-second' : isUserMessage }">
                <!-- <h1 v-if="!isUserMessage"> {{ message.relationships.owner.attributes.name}} </h1> -->
                <h2> {{ message.attributes.message }}</h2>
            </div>
        </div>
    </transition>
</template>

<script>
import { mapGetters } from 'vuex'
import UserAvatar from '../../User/UserAvatar'
export default {
    name: "Message",
    props: ["message"],
    components: {
        UserAvatar
    },
    computed: {
        ...mapGetters(["user"]),
        isUserMessage() {
            return this.message.relationships.owner.data.id === this.user.data.id;
        }
    },
    components: { UserAvatar }
}
</script>

<style lang="scss" scoped>

.fade-enter-active {
  transition: all 0.3s ease-out;
}

.fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter,
.fade-leave {
  transform: translateX(20px);
  opacity: 0;
}

</style>
