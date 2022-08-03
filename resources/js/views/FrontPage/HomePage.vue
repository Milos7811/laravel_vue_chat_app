<template>
    <div>
       <div class ="flex justify-end h-12 py-2 bg-light-second pr-5">
           <router-link :to="{ name: 'SignIn' }" class="w-[100px] mr-5 flex justify-center items-center border-2 border-theme rounded-sm font-bold">
               <div>Login</div>
           </router-link>

           <router-link :to="{ name: 'SignUp' }" class="w-[100px] flex justify-center items-center border-2 rounded-sm border-theme font-bold">
               <div >REGISTER</div>
           </router-link>
       </div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="scss" scoped>

</style>
