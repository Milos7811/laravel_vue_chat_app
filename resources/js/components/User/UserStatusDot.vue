<template>
    <div class="w-[7px] h-[7px] border-0 rounded-full animate-pulse"
        :class="[status === 'online' ? 'bg-green-600' : 'bg-red-600', !accepted ? 'bg-light-fg' : '']">

    </div>
</template>

<script>
export default {
    name: 'UserStatusDot',
    props: [ 'friendship' ],
    computed: {
        status () {
            return this.friendship.data.attributes.friend.data.attributes.status
        },
        accepted() {
            return this.friendship.data.attributes.status === 'accepted'
        }
    },
}
</script>

<style lang="scss" scoped>

</style>
