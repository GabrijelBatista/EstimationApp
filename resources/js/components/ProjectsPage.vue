<template>
    <div>
    <div class="md:h-75 md:flex mb-2 w-full">
            <input id="search" @keyup.enter="search_projects" v-model="search" class="border-2 mx-auto border-brand-dark bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                   type="search" name="search" placeholder="Search">
    </div>
<div class="container flex flex-grow items-center justify-center mx-auto px-4 md:px-12">
<div id="grid" class="flex w-full flex-wrap relative -mx-1 lg:-mx-4">
    <div  class="mx-auto" v-if="this.getUser && this.getUser.role_id===3">
        <div class="px-3 lg:px-4">
                <div class="my-3 px-3 lg:my-4 lg:px-4 bg-white max-w-xs shadow-lg mx-auto border-b-4 border-cta-dark rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                    <img class="cursor-pointer h-96" @click="modal=true" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Plus_symbol.svg/1200px-Plus_symbol.svg.png">
                </div>
        </div>
    </div>
    <div :key="project.id" v-if="this.getProjects" class="my-3 px-3 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3" v-for="project in this.getProjects.data">
            <router-link class="hover:no-underline" :to="'/project/'+project.name">
                <div class="bg-white h-96 max-w-xs mx-auto shadow-lg border-b-4 border-cta-dark rounded-2xl overflow-hidden  hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer" >
                    <div v-if="!project.sent_notsent && !project.approved_notapproved" :class="project.private_public ? 'bg-brand' : 'bg-gray-darkest'" class="flex h-14 items-center">
                        <p class="mx-auto font-bold inline-block text-cta-light uppercase">{{project.name}}</p>
                        <p v-if="project.approved_notapproved===0 && project.sent_notsent===0 && project.private_public===0" class="mx-auto font-bold inline-block text-cta-light uppercase">In progress</p>
                        <p v-if="project.approved_notapproved===0 && project.sent_notsent===0 && project.private_public===1" class="mx-auto font-bold inline-block text-cta-light uppercase">Done</p>
                        <p v-if="project.approved_notapproved===0 && project.sent_notsent===1" class="mx-auto font-bold inline-block text-cta-light uppercase">Sent</p>
                        <p v-if="project.approved_notapproved===1 " class="mx-auto font-bold inline-block text-cta-light uppercase">Approved</p>
                    </div>
                    <div v-if="project.sent_notsent && !project.approved_notapproved" class="flex h-14 bg-blue-600 items-center">
                        <p class="mx-auto font-bold text-cta-light uppercase">{{project.name}}</p>
                    </div>
                    <div v-if="project.approved_notapproved" class="flex bg-green-500 h-14 items-center">
                        <p class="mx-auto font-bold text-cta-light uppercase">{{project.name}}</p>
                    </div>
                    <div v-if="project.average_hours">
                        <p class="py-1 ml-4 text-lg text-blue-600 tracking-wide">Average: {{ project.average_hours }}h {{project.average_minutes}}m</p>
                        <p class="py-1 ml-4 text-lg text-green-600 tracking-wide">Best case: {{ project.best_hours }}h {{ project.best_minutes }}m</p>
                        <p class="py-1 ml-4 text-lg text-red-600 tracking-wide">Worst case: {{ project.worst_hours }}h {{ project.worst_minutes }}m</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Modules: {{ project.modules.length }}</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Tasks: {{ project.tasks }}</p>
                        <p class="py-1 ml-4 text-lg tracking-wide">Last update: {{ project.updated }}</p>
                    </div>
                        <div class="py-1 ml-4 text-lg tracking-wide">
                            <div class="inline-block mr-4">Author: </div>
                            <img v-if="project.author.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+project.author.logo" alt="" >
                            <img v-if="!project.author.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" /><div class="ml-2 inline-block">{{ project.author.name }}</div>
                        </div>
                    <div class="py-1 ml-4 text-lg tracking-wide">
                        <div class="inline-block mr-4">PM: </div>
                        <img v-if="project.pm.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+project.pm.logo" alt="" >
                        <img v-if="!project.pm.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" /><div class="ml-2 inline-block">{{ project.pm.name }}</div>
                    </div>
                    <div class="py-1 ml-4 text-lg tracking-wide">
                        <div class="inline-block mr-4">Dev: </div>
                        <img v-if="project.assigned_to.logo" class="inline-block h-6 w-6 rounded-full" :src="'/storage/images/profile/'+project.assigned_to.logo" alt="" >
                        <img v-if="!project.assigned_to.logo" class="inline-block h-6 w-6 rounded-full" src="/storage/images/user.png" alt="" /><div class="ml-2 inline-block">{{ project.assigned_to.name }}</div>
                    </div>
                </div>
            </router-link>
    </div>
    <div v-if="this.getProjects.total">
    <VueTailwindPagination
        v-if="this.getProjects.total>15"
        class="mx-auto"
        :current="this.getProjects.current_page"
        :total="this.getProjects.total"
        :per-page="this.getProjects.per_page"
        @page-changed="get_projects($event)"/>
    </div>
</div>
    <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-darkest bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-cta-light rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <div class="font-extrabold text-brand-dark mx-auto text-2xl mb-4">CREATE PROJECT</div>
            <input v-model="name" type="text" required class="text-center appearance-none rounded-none relative block w-full mx-auto py-2 border border-cta-light placeholder-brand-dark text-brand-dark rounded-md focus:outline-none focus:ring-brand focus:border-brand focus:z-10 sm:text-sm" placeholder="Project Name" />
            <Multiselect
                v-model="assigned_to"
                :options="this.getDevelopers"
                :searchable="true"
                valueProp="id"
                label="name"
                trackBy="name"
                placeholder="Choose Developer:"
                class="mx-auto my-2"
            />
            <Multiselect
                v-model="pm"
                :options="this.getPms"
                :searchable="true"
                valueProp="id"
                label="name"
                trackBy="name"
                placeholder="Choose Project Manager:"
                class="mx-auto my-2"
            />
            <div class="mx-auto block">
                <div @click="modal=false" class="inline-block bg-brand hover:bg-brand-dark px-4 float-left mt-4 mx-auto py-2 text-cta-light font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Cancel</span>
                </div>
                <div @click="add_project" class="inline-block bg-brand hover:bg-brand-dark px-4 float-right mt-4 mx-auto my-2 py-2 text-cta-light font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
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
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination'

export default {
    components: {
        Multiselect,
        VueTailwindPagination
    },
    data() {
       return {
           assigned_to: null,
           name: null,
           modal: false,
           pm: null,
           search: null,
       }
    },
    computed:{
        ...mapGetters([
            'getUser',
            'getProjects',
            'getUsers',
            'getPms',
            'getDevelopers'
        ])
    },
    methods: {
        search_projects(){
            if(this.search.length>2) {
                axios.get('http://estimate.local.com/api/search/'+this.search)
                    .then(response => {
                        this.$store.commit('setProjects', response.data)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
        },
        add_project(){
            axios.post('http://estimate.local.com/api/add_project', {
                name: this.name,
                assigned_to: this.assigned_to,
                pm: this.pm
            })
                .then(response => {
                    axios.get('http://estimate.local.com/api/get_projects')
                        .then(response => {
                            this.$store.commit('setProjects', response.data)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                    if(this.assigned_to!=this.getUser.id) {
                        axios.post('http://estimate.local.com/api/estimations-notification', {
                            for: this.assigned_to,
                            pm: this.pm,
                            body: 'Project '+this.name+' was assigned to you!',
                            url: response.data.name
                        })
                            .then(response => {
                                //console.log(response)
                            })
                            .catch(function (error) {
                                console.log(error.data)
                            });
                    }
                    this.name=null
                    this.assigned_to=null
                    this.pm=null
                    this.$toast.success('Project created!')
                    this.$store.commit('setCurrentProject', response.data)
                    this.$router.push('/project/'+response.data.name)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        get_projects(event){
            axios.get('http://estimate.local.com/api/get_projects?page='+event)
                .then(response => {
                    this.$store.commit('setProjects', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
    },
    created(){
        axios.get('http://estimate.local.com/api/get_projects')
            .then(response => {
                this.$store.commit('setProjects', response.data)
            })
            .catch(function (error) {
                console.error(error);
            });
        if(this.getUser.role_id===3 || this.getUser.role_id===2) {
            axios.get('http://estimate.local.com/api/get_users')
                .then(response => {
                    this.$store.commit('setUsers', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
        this.$store.commit('setCurrentProject', null)
    },
    mounted() {
        const store=this.$store
        document.getElementById("search").addEventListener("search", function(event) {
            axios.get('http://estimate.local.com/api/get_projects')
                .then(response => {
                    store.commit('setProjects', response.data)
                })
                .catch(function (error) {
                    console.error(error);
                });
        });
    }
}
</script>
