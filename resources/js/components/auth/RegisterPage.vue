<template>
    <div class=" flex items-center justify-center bg-cta-light py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mt-28 space-y-8">
            <div>
                <!-- <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-brand.svg" alt="Workflow" /> -->
                <h2 class="mt-6 text-center text-3xl font-extrabold text-brand">
                    Register new account
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="pb-1">
                        <label for="username" class="sr-only">Username</label>
                        <input id="username" v-model="this.name" autocomplete="off" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-black rounded-t-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Username" />
                    </div>
                    <div class="py-1">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" v-model="this.email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-black rounded-t-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Email address" />
                    </div>
                    <div class="py-1">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" v-model="this.password" autocomplete="off" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-black rounded-b-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Password" />
                    </div>
                    <div class="pt-1">
                        <label for="password_confirmation" class="sr-only">Password Confirmation</label>
                        <input id="password_confirmation" autocomplete="off" v-model="this.password_confirmation" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-black rounded-b-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Password Confirmation" />
                    </div>
                </div>

                <div>
                    <button @click="handleSubmit" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-brand hover:bg-brand focus:outline-none focus:ring-2 hover:bg-brand-dark focus:ring-offset-2 focus:ring-brand">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-white" aria-hidden="true" />
            </span>
                        Sing up
                    </button>
                    <router-link to="/login" class="mt-4 float-left text-green-600 hover:text-green-600-dark font-italic">You already have an account? Click here to sign in!</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { LockClosedIcon } from '@heroicons/vue/solid'
export default {
    components: {
        LockClosedIcon,
    },
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: ""
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                const toast=this.$toast
                    axios.post('http://estimate.local.com/api/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                    })
                        .then(response => {
                            if (response.data.success) {
                                this.$store.commit('setVerifyEmail', this.email)
                                this.$toast.success(response.data.message);
                                this.$router.push('/verification')
                            } else {
                                this.$toast.error(response.data.message);
                            }
                        })
                        .catch(function (error) {
                            toast.error(error.response.data.message);
                        });
            }
            else{
                this.$toast.error('All fields are required.')
            }
        },
    },
}
</script>
