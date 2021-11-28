<template>
    <div class="flex flex-grow items-center justify-center bg-cta-light py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mt-28 w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-brand">
                    Request Verification Code
                </h2>
            </div>
            <input type="hidden" name="remember" value="true" />
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="token" class="sr-only">Email</label>
                    <input id="token" v-model="email" name="token" type="text" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-black rounded-t-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Email" />
                </div>
            </div>
            <div>
                <button @click="request_token" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-brand hover:bg-brand focus:outline-none focus:ring-2 focus:ring-offset-2 hover:bg-brand-dark focus:ring-brand">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data() {
        return {
            email: null,
        }
    },
    methods: {
        request_token() {
            let e=this
            if (this.email) {
                axios.get('http://estimate.local.com/api/request_token/'+this.email)
                    .then(response => {
                        if (response.data.success) {
                            e.$store.commit('setVerifyEmail', this.email)
                            e.$toast.success('Token was sent to your email!')
                            e.$router.push('/password-reset')
                        }else {
                            e.$toast.error(response.data.message);
                        }
                    })
                    .catch(function (error) {
                        e.$toast.error(error.response.data.message);
                    });
            }
            else{
                e.$toast.error('Email field is required.')
            }
        },
    },
}
</script>
