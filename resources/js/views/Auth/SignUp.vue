<template>
    <form autocomplete="off" class="flex flex-col justify-center items-end h-screen w-2/4 m-auto ">

        <div class="mx-auto mb-2 md:flex md:max-w-lg md:items-center ">
            <label for="name" class="mb-1.5 block font-bold md:mb-0 md:w-72 md:pr-4 md:text-right">Name:</label>
            <div class="border-1 my-3 rounded-lg w-80 h-12 px-4 bg-third">
                <input v-model="form.name" type="text" class=" w-full h-full input bg-third"/>
            </div>
        </div>

         <div class="mx-auto mb-2 md:flex md:max-w-lg md:items-center">
            <label for="email" class="mb-1.5 block font-bold md:mb-0 md:w-72 md:pr-4 md:text-right">Email:</label>
            <div class="border-1 my-3 rounded-lg w-80 h-12 px-4 bg-third">
                <input v-model="form.email" type="email" class="w-full h-full input autofill:!bg-third"/>
            </div>
        </div>

        <div class="mx-auto mb-2 md:flex md:max-w-lg md:items-center">
            <label for="password" class="mb-1.5 block font-bold md:mb-0 md:w-72 md:pr-4 md:text-right">Password:</label>
            <div class="border-1 my-3 rounded-lg w-80 h-12 px-4 bg-third">
                <input v-model="form.password" type="password" class="w-full h-full input bg-third"/>
            </div>
        </div>

        <div class="mx-auto mb-2 md:flex md:max-w-lg md:items-center">
            <label for="password" class="mb-1.5 block font-bold md:mb-0 md:w-72 md:pr-4 md:text-right">Confim Password</label>
            <div class="border-1 my-3 rounded-lg w-80 h-12 px-4 bg-third">
                <input v-model="form.password_confirmation" type="password" class="w-full h-full input bg-third"/>
            </div>
        </div>

        <Button @click.native="register" class="mx-auto mt-20">Register</Button>
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

</style>
