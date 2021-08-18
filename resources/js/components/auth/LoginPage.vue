<template>
    <div class=" flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mt-28 space-y-8">
            <div>
                <!-- <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" /> -->
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <input type="hidden" name="remember" value="true" />
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" v-model="this.email" type="email" autocomplete="email" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" v-model="this.password" type="password" autocomplete="current-password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" />
                    </div>
                </div>

                <div>
                    <button @click="handleSubmit" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
            </span>
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { LockClosedIcon } from '@heroicons/vue/solid'
import { mapGetters } from 'vuex'

export default {
    components: {
        LockClosedIcon,
    },
    data() {
        return {
            email: "",
            password: "",
        }
    },
    computed: {
        show_error: function(){
            return this.error
        },
        ...mapGetters([
            'getLive'
        ])
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            if (this.password.length > 0) {
                const toast=this.$toast
                axios.get('http://estimate.local/sanctum/csrf-cookie').then(response => {
                    axios.post('http://estimate.local/api/login', {
                        email: this.email,
                        password: this.password
                    })
                        .then(response => {
                            if (response.data.success) {
                                this.$toast.success(response.data.message)
                                this.$store.commit('setUser', response.data.user)
                                this.$router.push('/')
                                Echo.private('App.Models.User.' + response.data.user.id)
                                    .notification((notification) => {
                                        this.$store.commit('setUserNotifications', notification.estimation)
                                    });
                                if(response.data.user.unread_notifications[0]) {
                                    this.$store.commit('setNewNotification', true)
                                }
                                else{
                                    this.$store.commit('setNewNotification', false)
                                }
                                this.$store.commit('setLive', true)
                            } else {
                                this.$toast.error(response.data.message);
                            }
                        })
                        .catch(function (error) {
                            toast.error(error);
                        });
                })
            }
            else{
                this.$toast.error('All fields are required.')
            }
        },
    },
}
</script>
