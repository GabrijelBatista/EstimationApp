<template>
    <div class="flex flex-grow items-center justify-center bg-cta-light py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mt-28 w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-brand">
                    Verification
                </h2>
            </div>
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="token" class="sr-only">Verification code</label>
                        <span class="text-xs font-italic">Verification code was sent to your email.</span>
                        <input id="token" v-model="token" name="token" type="text" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-brand-light placeholder-brand text-brand-dark rounded-t-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Verification code" />
                    </div>
                </div>
                <div>
                    <button @click="verify" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-brand hover:bg-brand focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand">
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
            token: null,
        }
    },
    computed: {
    ...mapGetters([
            'getVerifyEmail'
        ])
    },
    methods: {
        verify() {
            if (this.token && this.token.length === 8) {
                    axios.get('http://estimate.local.com/api/verify_token/'+this.token+'/'+this.getVerifyEmail)
                        .then(response => {
                            if (response.data.success) {
                                this.$toast.success('Email verified!')
                                this.$router.push('/login')
                            }else {
                                this.$toast.error(response.data.message);
                            }
                        })
                        .catch(function (error) {
                            this.$toast.error(error.response.data.message);
                        });
            }
            else{
                this.$toast.error('Incorrect verification code.')
            }
        },
    },
}
</script>
