<template>
    <div class="h-full">
        <ValidationObserver
            ref="register"
            v-slot="{ invalid }"
            tag="form"
            v-on:keydown.enter="register"
            class="flex flex-col justify-center items-end h-full m-auto">

            <div class="mx-auto">
                <div class="flex flex-col items-end">

                    <!-- Name -->
                    <div class="mb-2 flex flex-row items-center wrapper my-2">
                        <label for="name" class="mr-4 text-xl">Name:</label>
                        <ValidationProvider
                            tag="div"
                            mode="passive"
                            name="Name"
                            rules="required"
                            v-slot="{ errors }">
                            <div class="border-2 rounded-lg bg-light w-80 h-12 px-4 border-theme"
                                :class="{'border-red-600' : errors[0]}">
                                <input
                                    ref="name_input"
                                    v-model="form.name"
                                    placeholder="Name"
                                    type="text"
                                    class=" w-full h-full input "/>
                            </div>
                            <span class="text-left text-red-600"> {{ errors[0]}}</span>
                        </ValidationProvider>

                    </div>

                    <!-- Email -->
                    <div class="mb-2 flex flex-row items-center wrapper my-2">
                        <label for="email" class="mr-4 text-xl">E-Mail:</label>
                        <ValidationProvider
                            tag="div"
                            mode="passive"
                            name="E-mail"
                            rules="required"
                            v-slot="{ errors }">
                            <div class="border-2 rounded-lg w-80 h-12 px-4 border-theme"
                                :class="{'border-red-600' : errors[0]}">
                                <input
                                    v-model="form.email"
                                    type="email"
                                    placeholder="E-Mail"
                                    class="w-full h-full input"/>
                            </div>
                            <span class="text-left text-red-600"> {{ errors[0]}}</span>
                        </ValidationProvider>
                    </div>

                    <!-- Password -->
                    <div class="mb-2 flex flex-row items-center wrapper my-2">
                        <label for="password" class="mr-4 text-xl">Password:</label>
                        <ValidationProvider
                            tag="div"
                            mode="passive"
                            name="Password"
                            rules="required"
                            v-slot="{ errors }">
                            <div class="border-2 rounded-lg w-80 h-12 px-4 border-theme"
                                :class="{'border-red-600' : errors[0]}">
                                <input
                                    v-model="form.password"
                                    type="password"
                                    placeholder="Password"
                                    class="w-full h-full input"/>
                            </div>
                            <span class="text-left text-red-600"> {{ errors[0]}}</span>
                        </ValidationProvider>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-2 flex flex-row items-center wrapper my-2">
                        <label for="password" class="mr-4 text-xl">Confirm Password</label>
                        <ValidationProvider
                            tag="div"
                            mode="passive"
                            name="Confirm Password"
                            rules="required"
                            v-slot="{ errors }">
                            <div class="border-2 rounded-lg w-80 h-12 px-4 border-theme"
                                :class="{'border-red-600' : errors[0]}">
                                <input
                                    v-model="form.password_confirmation"
                                    type="password"
                                    placeholder="Confirm Password"
                                    class="w-full h-full input"/>
                            </div>
                            <span class="text-left text-red-600"> {{ errors[0]}}</span>
                        </ValidationProvider>
                    </div>

                </div>
            </div>


            <Button @click.native="register" class="mx-auto mt-20 bg-theme-second">Register</Button>
        </ValidationObserver>
    </div>
</template>

<script>
import Button from '../../components/Button'
import { ValidationObserver, ValidationProvider } from 'vee-validate/dist/vee-validate.full'

    export default {
    name: "SingUp",
    components: {
        ValidationObserver,
        ValidationProvider,
        Button
    },
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
                .catch((error) => {
                    console.log(error.response)
                    this.$refs.register.setErrors({
                        'Name' : error.response.data.errors.name ? [error.response.data.errors.name[0]] : null ,
                        'E-mail': error.response.data.errors.email ? [error.response.data.errors.email[0]] : null,
                        'Password': error.response.data.errors.password ? [error.response.data.errors.password[0]] : null,
                        'Confirm Password' : error.response.data.errors.password ? [error.response.data.errors.password[0]] : null,
                    })
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
