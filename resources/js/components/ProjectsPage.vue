<template>
<div class="container flex flex-grow items-center justify-center mx-auto px-4 md:px-12">
<div class="flex w-full flex-wrap relative -mx-1 lg:-mx-4">
    <div v-if="this.getUser" class="my-3 px-3 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
        <div v-if="this.getUser.role_id===3 || this.getUser.role_id===2" class="">
                <div class="bg-white max-w-xs shadow-lg mx-auto border-b-4 border-dark rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                    <img class="cursor-pointer h-96" @click="modal=true" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png">
                </div>
        </div>
    </div>
    <div :key="project.id" class="my-3 px-3 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3" v-for="project in this.getProjects">
            <router-link class="hover:no-underline" :to="'/project/'+project.name">
                <div class="bg-white h-96 max-w-xs mx-auto shadow-lg border-b-4 border-dark rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                    <div v-if="!project.sent_notsent && !project.approved_notapproved" :class="project.private_public ? 'bg-indigo-500' : 'bg-gray-500'" class="flex h-14 items-center">
                        <p class="mx-auto font-bold text-white uppercase">{{project.name}}</p>
                    </div>
                    <div v-if="project.sent_notsent && !project.approved_notapproved" class="flex h-14 bg-blue-600 items-center">
                        <p class="mx-auto font-bold text-white uppercase">{{project.name}}</p>
                    </div>
                    <div v-if="project.approved_notapproved" class="flex bg-green-500 h-14 items-center">
                        <p class="mx-auto font-bold text-white uppercase">{{project.name}}</p>
                    </div>
                    <div v-if="project.average_hours">
                        <p class="py-1 ml-4 text-lg text-blue-600 tracking-wide">Average: {{ project.average_hours }}h {{project.average_minutes}}m</p>
                        <p class="py-1 ml-4 text-lg text-green-600 tracking-wide">Best case: {{ project.best_hours }}h {{ project.best_minutes }}m</p>
                        <p class="py-1 ml-4 text-lg text-red-600 tracking-wide">Worst case: {{ project.worst_hours }}h {{ project.worst_minutes }}m</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Modules: {{ project.modules.length }}</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Tasks: {{ project.tasks }}</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Created: {{ project.created }}</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Last update: {{ project.updated }}</p>
                    </div>
                        <div class="py-1 ml-4 text-lg tracking-wide">
                            <div class="inline-block mr-4">Author: </div>
                            <img v-if="project.author.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+project.author.logo" alt="" >
                            <img v-if="!project.author.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" /><div class="ml-2 inline-block">{{ project.author.name }}</div>
                        </div>
                    <div class="py-1 ml-4 text-lg tracking-wide">
                        <div class="inline-block mr-4">Assigned to: </div>
                        <img v-if="project.assigned_to.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+project.assigned_to.logo" alt="" >
                        <img v-if="!project.assigned_to.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" /><div class="ml-2 inline-block">{{ project.assigned_to.name }}</div>
                    </div>
                </div>
            </router-link>
    </div>
</div>
    <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <div class="font-extrabold mx-auto text-2xl mb-4">CREATE PROJECT</div>
            <input v-model="name" type="text" required class="text-center appearance-none rounded-none relative block w-full mx-auto py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Project Name" />
            <Multiselect
                v-model="assigned_to"
                :options="this.getUsers"
                :searchable="true"
                valueProp="id"
                label="name"
                trackBy="name"
                placeholder="Assign to:"
                class="mx-auto my-2"
            />
            <div class="mx-auto block">
                <div @click="modal=false" class="inline-block bg-gray-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Cancel</span>
                </div>
                <div @click="add_project" class="inline-block bg-indigo-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<style src="@vueform/multiselect/themes/default.css"></style>
<script>
import { mapGetters } from 'vuex'
import Multiselect from '@vueform/multiselect'
import axios from "axios";
export default {
    components: {
        Multiselect,
    },
    data() {
       return {
           assigned_to: null,
           name: null,
           modal: false,
       }
    },
    computed:{
        ...mapGetters([
            'getUser',
            'getProjects',
            'getUsers'
        ])
    },
    methods: {
        add_project(){
            axios.post('http://estimate.local/api/add_project', {
                name: this.name,
                assigned_to: this.assigned_to
            })
                .then(response => {
                    axios.get('http://estimate.local/api/get_projects')
                        .then(response => {
                            this.$store.commit('setProjects', response.data)
                        })
                        .catch(function (error) {
                            console.error(error);
                        });

                    if(this.assigned_to!=this.getUser.id) {
                        axios.post('http://estimate.local/api/estimations-notification', {
                            for: this.assigned_to,
                            body: 'New project was assigned to you!',
                            url: response.data.name
                        })
                            .then(response => {
                                //console.log(response)
                            })
                            .catch(function (error) {
                                console.log(error.data)
                            });
                    }
                    this.$toast.success('Project created!')
                    this.$store.commit('setCurrentProject', response.data)
                    this.$router.push('/project/'+response.data.name)
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    },
    created(){
        axios.get('http://estimate.local/api/get_projects', {
            name: this.name,
        })
            .then(response => {
                this.$store.commit('setProjects', response.data)
            })
            .catch(function (error) {
                console.error(error);
            });
        if(this.getUser.role_id===3 || this.getUser.role_id===2) {
            axios.get('http://estimate.local/api/get_users')
                .then(response => {
                    this.$store.commit('setUsers', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
        this.$store.commit('setCurrentProject', null)
    }
}
</script>
