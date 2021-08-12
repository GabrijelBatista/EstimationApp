<template>
<div class="overflow-x-auto">
<div class="min-w-screen min-h-scree flex justify-center font-sans overflow-hidden">
    <div v-if="this.getCurrentProject" class="w-full lg:w-5/6">
            <div class="flex m-auto w-max">
                <div class="p-5 font-extrabold uppercase text-3xl leading-normal">{{ this.getCurrentProject.name }}</div>
            </div>
        <div @click="edit=value.id" class="flex flex-col" v-for="(value, index) in this.getCurrentProject.modules" :key="value.id">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-3 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow bg-dark overflow-hidden border-b border-gray-200 rounded-2xl">
            <div class="mt-4">
            <div class="min-w-max relative w-full">
                <div class="pb-3 font-bold text-white uppercase text-lg leading-normal"><div class="absolute left-4 w-6">
                    {{ index+1 }}.</div><div class="inline-block">
                    {{ value.name }}</div></div>
            </div>
            <table class="min-w-max w-full">
                <thead class="bg-gray-800">
                <tr class="text-white text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No.</th>
                    <th class="py-3 px-6 text-left">TASK</th>
                    <th class="py-3 px-6 text-green-600 text-center">BEST CASE</th>
                    <th class="py-3 px-6 text-blue-600 text-center">AVERAGE</th>
                    <th class="py-3 px-6 text-red-600 text-center">WORST CASE</th>
                    <th class="py-3 px-6 text-center"></th>
                </tr>
                </thead>
                <tbody class="text-white text-sm font-light">
                <tr v-if="value.tasks[0]" v-for="(value2, index2) in value.tasks" :key="value2.id" class="border-b border-gray-200">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{index+1}}.{{index2+1}}.</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ value2.name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="font-bold flex items-center text-green-600 justify-center">
                            {{value2.best_hours}}h {{value2.best_minutes}}m
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex font-bold text-blue-600 items-center justify-center">
                            {{value2.average_hours}}h {{value2.average_minutes}}m
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex font-bold text-red-600 items-center justify-center">
                            {{value2.worst_hours}}h {{value2.worst_minutes}}m
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform cursor-pointer text-red-500 hover:text-red-700 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr v-if="edit==value.id" class="border-2 border-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap w-16">
                        <div class="flex w-16 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex  items-center">
                            <input v-model="task.name" type="text" required class=" appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Task" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex w-36 mx-auto items-center">
                            <input v-model="task.best_case.hours" type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="h" />:
                            <input v-model="task.best_case.minutes" type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex  mx-auto w-36 items-center">

                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex mx-auto w-36 items-center">
                            <input v-model="task.worst_case.hours" type="number" min="0" required class="text-center appearance-none mr-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="h" />:
                            <input v-model="task.worst_case.minutes" type="number" min="0" max="59" required class="text-center appearance-none ml-1 rounded-none relative block w-full px-1 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="m" />
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform text-green-500 hover:text-green-700 hover:scale-110">
                                <svg @click="add_task(value.id)" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
                <thead class="bg-gray-800">
                <tr class="text-white text-sm leading-normal">
                    <th class="py-3 px-6 text-left"></th>
                    <th class="py-3 px-6 text-left">TOTAL</th>
                    <th class="py-3 px-6 text-green-600 text-center">{{ value.best_hours }}h {{ value.best_minutes }}m</th>
                    <th class="py-3 px-6 text-blue-600 text-center">{{ value.best_hours }}h {{ value.best_minutes }}m</th>
                    <th class="py-3 px-6 text-red-600 text-center">{{ value.average_hours }}h {{ value.average_minutes }}m</th>
                    <th class="py-3 px-6 text-center"></th>
                </tr>
                </thead>
            </table>
        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div v-if="modal" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 bg-opacity-75 flex flex-col items-center justify-center">
        <div class="w-full md:w-1/3 items-center p-6 space-x-6 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-500">
            <input v-model="module.name" type="text" required class="text-center appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Module Name" />
            <div class="block">
                <div @click="modal=false" class="inline-block bg-indigo-600 px-4 float-left mt-4 mx-auto py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Close</span>
                </div>
                <div @click="add_module" class="inline-block bg-indigo-600 px-4 float-right mt-4 mx-auto my-2 py-2 text-white font-semibold rounded-lg hover:shadow-lg transition duration-3000 cursor-pointer">
                    <span>Save</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex m-auto w-max">
        <div @click="modal=true" class="px-5 py-3 mt-4 cursor-pointer bg-green-300 hover:bg-green-400 rounded-2xl border-2 font-extrabold uppercase text-xl leading-normal">Create Module</div>
    </div>
</div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from "axios";
import { useRoute } from 'vue-router'

export default{
    data(){
        return {
            edit: null,
            modal: false,
            module: {
                name: null,
            },
            task: {
                name: null,
                best_case: {
                    hours: null,
                    minutes: null
                },
                worst_case: {
                    hours: null,
                    minutes: null
                }
            }
        }
    },
    computed:{
        ...mapGetters([
            'getCurrentProject',
            'getProjects'
        ])
    },
    methods:{
        add_module(){
            if(this.module.name) {
                axios.post('http://estimate.local/api/add_module', {
                    name: this.module.name,
                    project_id: this.getCurrentProject.id
                })
                    .then(response => {
                        this.$toast.success('Module created!')
                        this.$store.commit('setCurrentProject', response.data)
                        this.module.name = null
                        this.modal=null
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
            else{
                this.$toast.error('Project name cannot be empty!')
            }
        },
        add_task(module_id){
            if(this.task.name && this.task.best_case.hours && this.task.best_case.minutes && this.task.worst_case.hours && this.task.worst_case.minutes) {
                axios.post('http://estimate.local/api/add_task', {
                    name: this.task.name,
                    best_hours: this.task.best_case.hours,
                    best_minutes: this.task.best_case.minutes,
                    worst_hours: this.task.worst_case.hours,
                    worst_minutes: this.task.worst_case.minutes,
                    module_id: module_id
                })
                    .then(response => {
                        this.$toast.success('Module created!')
                        this.$store.commit('setCurrentProject', response.data)
                        this.module.name = null
                        this.modal=null
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            }
            else{
                this.$toast.error('All fields are required!')
            }
        }
    },
    created(){
        let current=null
        this.getProjects.findIndex(function(project) {
            if(project.name == useRoute().params.name)
                current=project
        });
        this.$store.commit('setCurrentProject', current)
    }
}
</script>
