<template>
    <div class="h-[40px] border-b-2 flex justify-center items-center">
        <h1 class="text-xl font-bold"> {{this.title}} </h1>
    </div>
</template>

<script>
export default {
    name: 'PopupHeader',
    props: ['title']

}
</script>

<style lang="scss" scoped>

</style>
