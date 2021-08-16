<template>
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
        <div class=" mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <DisclosureButton class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Open main menu</span>
                        <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow" />
                        <img class="hidden lg:block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow" />
                    </div>
                    <div class="hidden sm:block sm:ml-6">
                        <div v-if="this.getUser" class="flex space-x-4">
                            <router-link v-for="item in navigation" :key="item.name" :to="item.href" active-class="bg-gray-900 text-white" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ item.name }}</router-link>
                        </div>
                    </div>
                </div>
                <div v-if="this.getUser" class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <Menu as="div" class="ml-3 relative">
                            <MenuButton class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                <span class="sr-only">View notifications</span>
                                <BellIcon :class="this.getNewNotification ? 'text-yellow-500 hover:text-yellow-700' : '' " class="w-6 h-6" aria-hidden="true"/>
                            </MenuButton>
                        <transition v-if="this.getUserNotifications || this.getUser.unread_notifications" enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <div>
                            <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem :key="notification.id" v-for="notification in this.getUserNotifications" v-slot="{ active }">
                                    <div @click="read_notification(notification.id, true)" class="cursor-pointer hover:no-underline border-b w-full" :class="[!notification.read_at ? 'bg-yellow-500 hover:bg-yellow-700' : '', 'block px-4 py-2 text-sm text-gray-700']">{{notification.estimation.body}}</div>
                                </MenuItem>
                                <MenuItem :key="notification.id" v-for="notification in this.getUser.unread_notifications" v-slot="{ active }">
                                    <div @click="read_notification(notification.id, false)" :to="'/project/'+notification.data.estimation.estimationUrl" class="cursor-pointer hover:no-underline border-b w-full" :class="[!notification.read_at ? 'bg-yellow-500 hover:bg-yellow-700' : '', 'block px-4 py-2 text-sm text-gray-700']">{{notification.data.estimation.body}}</div>
                                </MenuItem>
                            </MenuItems>
                            </div>
                        </transition>
                    </Menu>

                    <!-- Profile dropdown -->
                    <Menu as="div" class="ml-3 relative">
                        <div>
                            <MenuButton class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                <span class="sr-only">Open user menu</span>
                                <img v-if="this.getUser.logo" class="h-8 w-8 rounded-full" :src="'/storage/images/profile/'+this.getUser.logo" alt="" />
                                <img v-if="!this.getUser.logo" class="h-8 w-8 rounded-full" src="/storage/images/user.png" alt="" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem v-slot="{ active }">
                                    <router-link :to="'/profile/'+this.getUser.name" class="hover:no-underline w-full" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">My Profile</router-link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <button @click="logout" class="w-full" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Sign out</button>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
                <div v-if="!this.getUser" class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <router-link to="/login" active-class="bg-gray-900 text-white" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</router-link>
                        <router-link to="/register" active-class="bg-gray-900 text-white" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</router-link>
                    </div>
                </div>
            </div>
        </div>

        <DisclosurePanel class="sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <router-link v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.name == current ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white', 'block px-3 py-2 rounded-md text-base font-medium']" :aria-current="item.current ? 'page' : undefined">{{ item.name }}</router-link>
            </div>
        </DisclosurePanel>
    </Disclosure>
</template>

<script>
import { ref } from 'vue'
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline'
import { mapGetters } from 'vuex'
import axios from "axios";
import {useRoute} from "vue-router";
import router from "../../router";

const navigation = [
    { name: 'Dashboard', href: '/'},
    { name: 'Projects', href: '/projects'},
]

export default {
    data(){
        return{

        }
    },
    components: {
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        BellIcon,
        MenuIcon,
        XIcon,
    },
    computed: {
        ...mapGetters([
            'getUser',
            'getUserNotifications',
            'getNewNotification'
        ])
    },
    methods: {
        read_notification(id, broadcast){
            let router=this.$router
            let url=null
            axios.get('http://estimate.local/api/read_notification/'+id)
                .then(response => {
                    this.$store.commit('readNotification', response.data)
                    if(!broadcast) {
                        this.getUser.unread_notifications.findIndex(function (not) {
                            if (response.data.id === not.id) {
                                not.read_at = response.data.read_at
                                router.push('/project/'+not.data.estimation.estimationUrl)
                                url=not.data.estimation.estimationUrl
                            }
                        });
                    }
                    else{
                        this.getUserNotifications.findIndex(function (not) {
                            if (response.data.id === not.id) {
                                not.read_at = response.data.read_at
                                router.push('/project/'+not.estimation.estimationUrl)
                                url=not.estimation.estimationUrl
                            }
                        });
                    }
                    axios.get('http://estimate.local/api/get_projects', {
                        name: this.name,
                    })
                        .then(response => {
                            this.$store.commit('setProjects', response.data)
                            let current=null
                            response.data.findIndex(function(project) {
                                if(project.name === url)
                                    current=project
                            });
                            this.$store.commit('setCurrentProject', current)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        logout(){
            axios.get('http://estimate.local/api/logout', {
                name: this.name,
            })
                .then(response => {
                    this.$toast.success('Logged out!')
                    this.$router.push('/login')
                    window.sessionStorage.clear()
                    window.localStorage.clear()
                    this.$store.commit('setUser', null)
                    this.$store.commit('setUserNotifications', null)
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    },
    setup() {
        const open = ref(false)

        return {
            navigation,
            open,
        }
    },
    created(){
        if(this.getUser) {
            Echo.private('App.Models.User.' + this.getUser.id)
                .notification((notification) => {
                    this.$store.commit('setUserNotifications', notification)
                });
            this.$store.commit('setLive', true)
        }
    }
}
</script>
