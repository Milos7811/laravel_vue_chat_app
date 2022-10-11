<template>
    <form v-on:keydown.enter="login"
        autocomplete="off" class="flex flex-col justify-center items-end h-screen m-auto">

        <div class="mx-auto">
            <div class="flex flex-col items-end">

                <div class="mb-2 flex flex-row items-center wrapper">
                    <label for="name" class="mr-4 text-xl">Name:</label>
                    <div class="border-2 my-3 rounded-lg w-80 h-12 px-4 border-theme">
                        <input v-model="form.name" type="text" class=" w-full h-full input "/>
                    </div>
                </div>

                 <div class="mb-2 flex flex-row items-center wrapper">
                    <label for="email" class="mr-4 text-xl">Email:</label>
                    <div class="border-2 my-3 rounded-lg w-80 h-12 px-4 border-theme">
                        <input v-model="form.email" type="email" class="w-full h-full input"/>
                    </div>
                </div>

                <div class="mb-2 flex flex-row items-center wrapper">
                    <label for="password" class="mr-4 text-xl">Password:</label>
                    <div class="border-2 my-3 rounded-lg w-80 h-12 px-4 border-theme">
                        <input v-model="form.password" type="password" class="w-full h-full input"/>
                    </div>
                </div>

                <div class="mb-2 flex flex-row items-center wrapper">
                    <label for="password" class="mr-4 text-xl">Confim Password</label>
                    <div class="border-2 my-3 rounded-lg w-80 h-12 px-4 border-theme">
                        <input v-model="form.password_confirmation" type="password" class="w-full h-full input"/>
                    </div>
                </div>

            </div>
        </div>


        <Button @click.native="register" class="mx-auto mt-20 bg-theme-second">Register</Button>
    </form>
</template>

<script>
import axios from 'axios'
import Button from '../../components/Button.vue'

    export default {
    name: "SingUp",
    components: { Button },
    data () {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        register () {
            axios.
                post('/register', this.form)
                .then(() => {
                    this.$store.commit('SET_AUTH', true)

                    this.$router.push({name: 'Dashboard'})
                })
        }
    },
    mounted () {
        this.form.name = ''
        this.form.email = ''
        this.form.password = ''
        this.form.password_confirmation = ''
    }
}
</script>

<style lang="scss" scoped>

.input:focus {
    outline: none;
}

@media(max-width:530px) {
        .wrapper{
            flex-direction: column !important;
        }
    }

</style>
