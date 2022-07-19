<template>
    <div class="search-bar bg-third">
        <div class="h-full flex justify-center items-center relative">
            <div  class="w-2/3 p-2 bg-white border-0 rounded-lg">
                <input v-model="user"
                   @input="searchUser"
                    class="w-full">
            </div>
            <div v-if="dropDown" class="dropdown-searchbar bg-white absolute w-2/3 h-96 border-0 rounded-lg z-10"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SearchBar',
    data () {
        return {
            dropDown: false,
            user: ''
        }
    },
    methods: {
        searchUser () {
            console.log(this.user)
        }
    }
}
</script>

<style lang="scss" scoped>

.search-bar {
    height: 5%;
    .dropdown-searchbar  {
        top: 50px;
    }
}
</style>
