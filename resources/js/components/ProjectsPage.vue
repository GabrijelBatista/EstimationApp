<template>
<div class="container flex flex-grow items-center justify-center mx-auto px-4 md:px-12">
<div class="flex flex-wrap relative -mx-1 lg:-mx-4">
    <div v-if="this.getUser" class="my-3 px-3 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
        <div class="">
                <div class="bg-white max-w-xs shadow-lg mx-auto border-b-4 border-indigo-500 rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                    <button @click="modal=true">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png">
                    </button>
                </div>
        </div>
    </div>
    <div :key="project.id" class="my-3 px-3 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3" v-for="project in this.getProjects">
            <router-link class="hover:no-underline" :to="'/project/'+project.name">
                <div class="bg-white max-w-xs mx-auto shadow-lg border-b-4 border-indigo-500 rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                    <div class="bg-indigo-500  flex h-20  items-center">
                        <p class="ml-4 text-white uppercase">{{project.name}}</p>
                    </div>
                    <div v-if="project.average_hours">
                        <p class="py-2 ml-4 text-lg tracking-wide">Average: {{ project.average_hours }}h {{project.average_minutes}}m</p>
                        <p class="py-2 ml-4 text-lg tracking-wide">Best case: {{ project.best_hours }}h {{ project.best_minutes }}m</p>
                        <p class="py-2 ml-4 text-lg tracking-wide">Worst case: {{ project.worst_hours }}h {{ project.worst_minutes }}m</p>
                        <p class="py-2 ml-4 text-lg tracking-wide">Modules: {{ project.modules.length }}</p>
                        <p class="py-2 ml-4 text-lg tracking-wide">Tasks: {{ project.tasks }}</p>
                    </div>
                        <p class="py-2 ml-4 text-lg tracking-wide">Author: <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" :src="project.author.logo" alt="" />
                            {{ project.author.name }}</p>
                </div>
            </router-link>
    </div>
</div>
    <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <input v-model="name" type="text" required class="text-center appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Project Name" />
            <div class="block">
                <div @click="modal=false" class="inline-block bg-indigo-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Close</span>
                </div>
                <div @click="update_profile" class="inline-block bg-indigo-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from "axios";
import { mapGetters } from 'vuex'
export default {
    data() {
       return {
           name: null,
           modal: false,
       }
    },
    computed:{
        ...mapGetters([
            'getUser',
            'getProjects'
        ])
    },
    methods: {
        add_project(){
            axios.post('http://estimate.local/api/add_project', {
                name: this.name,
            })
                .then(response => {
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
    }
}
</script>
