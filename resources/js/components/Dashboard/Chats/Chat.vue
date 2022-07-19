<template>
    <div class="flex flex-row items-center">
        <div class="w-10 h-10 bg-third border rounded-full mr-3"></div>

        <div class="flex flex-col">

            <div class="flex">
                <div v-for="member of chat.data.relationships.members" :key="member.data.id">
                    {{ `${member.data.attributes.name}` }}
                </div>
            </div>
            <div class="cursor-pointer">Message</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Chat',
    props: ['chat'],

}
</script>

<style lang="scss" scoped>

</style>
