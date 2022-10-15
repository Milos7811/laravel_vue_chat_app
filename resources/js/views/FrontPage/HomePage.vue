<template>
    <div class="min-h-full">
       <div v-if="! isAuth" class ="flex justify-end h-12 py-2 bg-light-second pr-5">
           <router-link :to="{ name: 'SignIn' }" class="w-[100px] mr-5 flex justify-center items-center border-2 border-theme rounded-sm font-bold">
               <div>Login</div>
           </router-link>

           <router-link :to="{ name: 'SignUp' }" class="w-[100px] flex justify-center items-center border-2 rounded-sm border-theme font-bold">
               <div >REGISTER</div>
           </router-link>
       </div>

       <div v-if="isAuth" class="flex justify-end h-12 py-2 bg-light-second pr-5">
           <router-link :to="{name : 'Dashboard'}" class="w-[100px] flex justify-center items-center border-2 rounded-sm border-theme font-bold">
                <div> Dashboard</div>
           </router-link>
       </div>

       <div class="absolute top-[40%] w-full flex justify-center">
           <img src="/logo/vch_logo.png">
       </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'HomePage',
    computed: {
        ...mapGetters( ['config'] ),
        isAuth() {
            return config.authCheck ? config.authCheck : null
        }
    },
}
</script>

<style lang="scss" scoped>
</style>
