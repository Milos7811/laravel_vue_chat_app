<template>
    <div class="w-[7px] h-[7px] border-0 rounded-full animate-pulse"
        :class="[status === 'online' ? 'bg-green-600' : 'bg-red-600']">

    </div>
</template>

<script>
export default {
    name: 'UserStatusDot',
    props: [ 'status' ]
}
</script>

<style lang="scss" scoped>

</style>
