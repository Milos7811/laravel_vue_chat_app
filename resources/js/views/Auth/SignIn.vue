<template>
     <form class="flex flex-col justify-center items-end h-screen m-auto ">

         <div class="mx-auto">
            <div class="flex flex-col items-end">
                <div class="flex flex-row items-center ">
                    <label for="email" class="mr-4 text-xl">Email:</label>
                    <div class="border-2 my-3 rounded-lg w-80 h-12 px-4 bg-light border-theme">
                        <input v-model="form.email" type="email" class=" w-full h-full input bg-light "/>
                    </div>
                </div>
                <div class="flex flex-row items-center ">
                    <label for="password" class="mr-4 text-xl">Password:</label>
                    <div class="border-2 my-3 rounded-lg w-80 h-12 px-4 bg-light border-theme ">
                        <input v-model="form.password" type="password" class=" w-full h-full input bg-light"/>
                    </div>
                </div>
            </div>
            </div>
        <Button @click.native="login" class="mx-auto mt-20 bg-theme-second">Login</Button>
    </form>
</template>

<script>
import Button from '../../components/Button';

export default {
    name: 'SignIn',
    components: { Button },
    data () {
        return {
            form: {
                email: 'milosholba78@gmail.com',
                password: '12345678',
            }
        }
    },
    methods: {
        login () {
            axios.
                post('/login', this.form)
                .then((response) => {

                    this.$store.commit('SET_AUTH', true)

                    this.$router.push({name: 'Dashboard'})

                    this.$store.dispatch('updateUserStatus', 'online')
                })
        },
    },
}
</script>

<style lang="scss" scoped>

.input:focus {
    outline: none;
}

</style>
