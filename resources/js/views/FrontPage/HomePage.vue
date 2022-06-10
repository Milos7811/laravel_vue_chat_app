<template>
    <div>
       <div class ="flex justify-end h-12 py-2 bg-second">
           <router-link :to="{ name: 'SignIn' }">
               <div class="mx-4 w-20 flex justify-center items-center rounded-lg hover:text-second-text border-third cursor-pointer">Login</div>
           </router-link>

           <router-link :to="{ name: 'SignUp' }">
               <div class="mx-4 w-20 flex justify-center items-center rounded-lg hover:border-2 border-third cursor-pointer">Register</div>
           </router-link>
       </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="stylus" scoped>

</style>
