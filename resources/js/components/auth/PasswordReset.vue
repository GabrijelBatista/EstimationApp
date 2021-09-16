<template>
    <div class="flex flex-grow items-center justify-center bg-cta-light py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mt-28 w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-brand">
                    Create New Password
                </h2>
            </div>
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="token" class="sr-only">Verification Code</label>
                        <span class="text-xs font-italic">Verification code was sent to your email.</span>
                        <input v-model="token" id="token" name="token" type="token" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-b-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Verification Code" />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input v-model="password" id="password" name="password" type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-b-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="New Password" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Password</label>
                        <input v-model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-b-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Confirm Password" />
                    </div>
                </div>
                <div>
                    <button @click="handleSubmit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-brand hover:bg-brand focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand">
                        Confirm
                    </button>
                </div>
        </div>
    </div>
</template>

<script>
import {LockClosedIcon} from "@heroicons/vue/solid";
import {mapGetters} from "vuex";

export default {
    components: {
        LockClosedIcon,
    },
    data() {
        return {
            password: "",
            password_confirmation: "",
            token: ""
        }
    },
    computed: {
        ...mapGetters([
            'getVerifyEmail'
        ])
    },
    methods: {
        handleSubmit() {
            let e=this
            if (this.password && this.token && this.password_confirmation) {
                    axios.post('http://estimate.local.com/api/reset_password', {
                        token: this.token,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                        email: this.getVerifyEmail
                    })
                        .then(response => {
                            if (response.data.success) {
                                e.$toast.success('Password changed!');
                                e.$router.push('/login')
                            } else {
                                e.$toast.error(response.data.message);
                            }
                        })
                        .catch(function (error) {
                            e.$toast.error(error.response.data.message);
                        });
            }
            else{
                e.$toast.error('All fields are required.')
            }
        },
    }
}
</script>
