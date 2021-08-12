<template xmlns:x-transition="http://www.w3.org/1999/xhtml">
        <div class="w-screen flex m-auto">
            <div class="bg-white m-auto p-3 border-t-4 border-green-400">
                <div class="block relative overflow-hidden">
                    <input ref="file" id="fileUpload" class="absolute" @change="update_profile" hidden type="file">
                    <img v-if="this.getUser.logo" class="h-80 z-40 w-80 block rounded-full mx-auto"
                         :src="'/storage/images/profile/'+this.getUser.logo"
                         alt="">
                    <img v-if="!this.getUser.logo" class="h-80 z-40 w-80 block rounded-full mx-auto"
                         src="/storage/images/user.png"
                         alt="">
                    <svg v-if="!this.getUser.logo" @click="select_image" xmlns="http://www.w3.org/2000/svg" class="h-80 bg-dark text-white opacity-0 z-50 hover:opacity-70 absolute top-0 w-80 cursor-pointer rounded-full mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <div v-if="this.getUser.logo" class="h-80 bg-dark text-white opacity-0 z-50 hover:opacity-70 absolute top-0 p-32 w-80 rounded-full mx-auto">
                        <svg @click="select_image" xmlns="http://www.w3.org/2000/svg" class="inline-block mx-auto text-yellow-500 hover:text-yellow-700 cursor-pointer w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <svg  @click="confirm_modal=true" xmlns="http://www.w3.org/2000/svg" class="inline-block mx-auto text-red-500 hover:text-red-700 cursor-pointer w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                </div>
                <div class="block">
                    <h1 class="text-gray-900 inline-block font-bold text-xl italic leading-8 my-3">{{ this.getUser.name }}</h1>
                    <svg @click="modal=true" xmlns="http://www.w3.org/2000/svg" class="float-right inline-block cursor-pointer text-yellow-500 hover:text-yellow-700 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </div>
                    <li class="flex items-center py-3">
                        <span>Email</span>
                        <span class="italic ml-auto">{{ this.getUser.email }}</span>
                    </li>
                    <li class="flex items-center py-3">
                        <span>Member since</span>
                        <span class="italic ml-auto">{{ this.getUser.date }}</span>
                    </li>
            </div>
            <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
                <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
                    <div class="font-extrabold mx-auto text-2xl mb-4">UPDATE PROFILE</div>
                        <input v-model="name" type="text" required class="text-center mb-2 py-3 mx-auto appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="New Name" />
                        <input v-model="password" type="password" required class="text-center mb-2 py-3 mx-auto appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="New Password" />
                        <input v-model="password_confirmation" type="password" required class="text-center mb-2 py-3 mx-auto appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password Confirmation" />
                    <div class="block">
                        <div @click="cancel" class="inline-block bg-gray-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                            <span>Cancel</span>
                        </div>
                        <div @click="update_profile" class="inline-block bg-indigo-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                            <span>Save</span>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="confirm_modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
                <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
                    <div class="text-center p-5 flex-auto justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <h2 class="text-xl font-bold py-4 ">Are you sure?</h2>
                        <p class="text-sm text-gray-500 px-8">Do you really want to delete your profile photo?</p>
                    </div>
                    <div class="block">
                        <div @click="cancel" class="inline-block bg-gray-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                            <span>Cancel</span>
                        </div>
                        <div @click="delete_logo" class="inline-block bg-red-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                            <span>Delete</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</template>
<script>
import { mapGetters } from 'vuex'
import axios from "axios";
export default {
    data() {
        return {
            modal: false,
            confirm_modal: false,
            image: null,
            name: null,
            password: null,
            password_confirmation: null
        }
    },
    computed:{
        ...mapGetters([
            'getUser'
        ])
    },
    methods: {
        delete_logo(){
            axios.post('http://estimate.local/api/update_profile', {
                delete_image: true,
            })
                .then(response => {
                    this.$store.commit('setUser', response.data.user)
                    this.$toast.success(response.data.message)
                    this.confirm_modal = false
                })
                .catch(error => {
                    this.$toast.error('Given data is invalid!')
                })
        },
        update_profile(){
            let form = new FormData();
            if(this.$refs.file.files[0]) {
                this.image = this.$refs.file.files[0];
                form.append('image', this.image);
            }
            if(this.name) {
                form.append('name', this.name);
            }
            if(this.password) {
                form.append('password', this.password);
            }
            if(this.password_confirmation) {
                form.append('password_confirmation', this.password_confirmation);
            }
            axios.post('http://estimate.local/api/update_profile', form, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
                    .then(response => {
                        this.name = null
                        this.password = null
                        this.password_confirmation = null
                        this.image=null
                        this.$store.commit('setUser', response.data.user)
                        this.$toast.success(response.data.message)
                        this.modal = false
                    })
                    .catch(error => {
                        this.$toast.error('Given data is invalid!')
                    })
        },
        select_image(){
            document.getElementById("fileUpload").click()
        },
        cancel(){
                this.name = null
                this.password = null
                this.password_confirmation = null
                this.modal = false
                this.confirm_modal=false
        },
    },
    created(){

    }
}
</script>
