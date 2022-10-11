<template>
     <ValidationObserver
        ref="log_in"
        v-slot="{ invalid }"
        tag="form"
        v-on:keydown.enter="login"
        class="flex flex-col justify-center items-end h-screen m-auto">

         <div class="mx-auto">
            <div class="flex flex-col items-end ">
                <div class="flex flex-row items-center wrapper my-2">
                    <label for="email" class="mr-4 text-xl">Email:</label>
                    <ValidationProvider
                        tag="div"
                        mode="passive"
                        name="E-Mail"
                        rules="required"
                        v-slot="{ errors }">
                        <div class="border-2 rounded-lg w-80 h-12 px-4 bg-light border-theme"
                            :class="{'border-red-600' : errors[0]}">
                            <input
                                ref="email_input"
                                v-model="form.email"
                                type="email"
                                class=" w-full h-full input bg-light "/>
                        </div>
                        <span class="text-left text-red-600"> {{ errors[0]}}</span>
                    </ValidationProvider>
                </div>
                <div class="flex flex-row items-center wrapper my-2">
                    <label for="password" class="mr-4 text-xl">Password:</label>
                    <ValidationProvider
                        tag="div"
                        mode="passive"
                        name="Password"
                        rules="required"
                        v-slot="{ errors }">
                        <div class="border-2 my-1 rounded-lg w-80 h-12 px-4 bg-light border-theme "
                            :class="{'border-red-600' : errors[0]}">
                            <input
                                v-model="form.password"
                                type="password"
                                class=" w-full h-full input bg-light"/>
                        </div>
                        <span class="text-left text-red-600"> {{ errors[0]}}</span>
                    </ValidationProvider>
                </div>
            </div>
            </div>
        <Button @click.native="login" class="mx-auto mt-20 bg-theme-second">Login</Button>

    </ValidationObserver>
</template>

<script>
import Button from '../../components/Button';
import { ValidationObserver, ValidationProvider } from 'vee-validate/dist/vee-validate.full'

export default {
    name: 'SignIn',
    components: {
        ValidationObserver,
        ValidationProvider,
        Button
    },
    data () {
        return {
            form: {
                email: '',
                password: '',
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
                })
                .catch((error) => {
                    this.$refs.log_in.setErrors({
                        'E-Mail' : error.response.data.errors.email ? [error.response.data.errors.email[0]] : null,
                        'Password' : error.response.data.errors.password ? [error.response.data.errors.password[0]] : null
                    })
                })
        },
    },
    mounted () {
        this.$nextTick(() => {
            this.$refs.email_input.focus()
        })
    }
}
</script>

<style lang="scss" scoped>

    .input:focus {
        outline: none;
    }

    @media(max-width:500px) {
        .wrapper{
            flex-direction: column !important;
        }
    }


</style>
